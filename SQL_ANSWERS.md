# SQL Query Answers - Mini Shop Lite Assessment

## Query 1: Top 5 best-selling products by total quantity
```sql
SELECT 
    p.id,
    p.name,
    p.price,
    COALESCE(SUM(oi.quantity), 0) as total_quantity_sold
FROM products p
LEFT JOIN order_items oi ON p.id = oi.product_id
GROUP BY p.id, p.name, p.price
ORDER BY total_quantity_sold DESC
LIMIT 5;
```

**Screenshot:** This query shows the top 5 products by total units sold across all orders.

## Query 2: Total revenue per day for the last 7 days (show 0 on days with no orders)
```sql
SELECT 
    DATE(date_series.date) as order_date,
    COALESCE(SUM(o.total_amount), 0) as daily_revenue
FROM (
    SELECT CURDATE() - INTERVAL (a.a + (10 * b.a)) DAY as date
    FROM (SELECT 0 as a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) as a
    CROSS JOIN (SELECT 0 as a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) as b
    ORDER BY date DESC
    LIMIT 7
) as date_series
LEFT JOIN orders o ON DATE(o.created_at) = DATE(date_series.date)
GROUP BY DATE(date_series.date)
ORDER BY order_date DESC;
```

**Alternative simpler version for MySQL:**
```sql
SELECT 
    DATE(o.created_at) as order_date,
    SUM(o.total_amount) as daily_revenue
FROM orders o
WHERE o.created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
GROUP BY DATE(o.created_at)
ORDER BY order_date DESC;
```

**Screenshot:** This query shows daily revenue for the last 7 days, including days with zero revenue.

## Query 3: Per customer: number of orders and lifetime spend
```sql
SELECT 
    u.id as customer_id,
    u.name as customer_name,
    u.email,
    COUNT(o.id) as total_orders,
    COALESCE(SUM(o.total_amount), 0) as lifetime_spend
FROM users u
LEFT JOIN orders o ON u.id = o.user_id
WHERE u.role = 'customer'
GROUP BY u.id, u.name, u.email
ORDER BY lifetime_spend DESC;
```

**Screenshot:** This query provides customer analytics showing order count and total spending per customer.

## Database Schema Overview

### Tables Structure:
```sql
-- users (id, name, email, password, role: admin/customer)
-- products (id, name, price, stock, description)
-- orders (id, user_id, total_amount, created_at)
-- order_items (id, order_id, product_id, quantity, price)
-- carts (id, user_id, product_id, quantity) [for session alternative]
```

### Key Relationships:
- Users (1:many) Orders
- Orders (1:many) OrderItems  
- Products (1:many) OrderItems
- Users (1:many) Carts
- Products (1:many) Carts

### Sample Data Insights:
- 10 seeded products with realistic pricing ($39.99 - $1499.99)
- Demo users: admin@demo.com and customer@demo.com
- Stock levels: 20-200 units per product
- Order processing reduces stock automatically
