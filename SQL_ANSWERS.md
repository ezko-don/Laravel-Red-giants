# SQL Query Answers - Mini Shop Lite Assessment

## Query 1: Get all orders with their customer information and total amount
```sql
SELECT 
    o.id as order_id,
    o.created_at as order_date,
    o.status,
    o.total_amount,
    u.name as customer_name,
    u.email as customer_email
FROM orders o
JOIN users u ON o.user_id = u.id
ORDER BY o.created_at DESC;
```

**Screenshot:** This query retrieves all orders along with customer details, showing order ID, date, status, total amount, and customer information.

## Query 2: Get products with their sales statistics
```sql
SELECT 
    p.id,
    p.name,
    p.price,
    p.stock,
    COALESCE(SUM(oi.quantity), 0) as total_sold,
    COALESCE(SUM(oi.quantity * oi.price), 0) as total_revenue,
    COUNT(DISTINCT oi.order_id) as number_of_orders
FROM products p
LEFT JOIN order_items oi ON p.id = oi.product_id
GROUP BY p.id, p.name, p.price, p.stock
ORDER BY total_revenue DESC;
```

**Screenshot:** This query shows product performance metrics including total units sold, revenue generated, and number of orders containing each product.

## Query 3: Get customer purchase history with order details
```sql
SELECT 
    u.name as customer_name,
    u.email,
    COUNT(DISTINCT o.id) as total_orders,
    COALESCE(SUM(o.total_amount), 0) as total_spent,
    MAX(o.created_at) as last_order_date,
    GROUP_CONCAT(
        CONCAT(p.name, ' (', oi.quantity, 'x)')
        ORDER BY oi.created_at DESC
        SEPARATOR ', '
    ) as recent_products
FROM users u
LEFT JOIN orders o ON u.id = o.user_id
LEFT JOIN order_items oi ON o.id = oi.order_id
LEFT JOIN products p ON oi.product_id = p.id
WHERE u.role = 'customer'
GROUP BY u.id, u.name, u.email
ORDER BY total_spent DESC;
```

**Screenshot:** This query provides comprehensive customer analytics including total orders, spending amount, last order date, and recent product purchases.

## Database Schema Overview

### Key Relationships:
- Users (1:many) Orders
- Users (1:many) Carts
- Orders (1:many) OrderItems
- Products (1:many) OrderItems
- Products (1:many) Carts

### Index Recommendations:
1. `orders(user_id, created_at)` - For customer order history
2. `order_items(product_id)` - For product sales analysis
3. `carts(user_id)` - For cart operations
4. `products(stock)` - For inventory queries

### Performance Notes:
- Use database transactions for order processing
- Consider caching frequently accessed product data
- Implement soft deletes for orders and products for audit trail
