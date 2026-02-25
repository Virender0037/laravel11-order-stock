Project 2 – Order & Stock Management System

Stack: Laravel 11 | MySQL | Feature Testing | Factories | Policies

🎯 Goal

This project focuses on building a real-world backend system that goes beyond CRUD.

The objective is to simulate a production-style Order & Inventory Management system while applying:

Transaction-safe operations

Stock consistency logic

Feature testing

Clean architecture practices

Database constraints & indexing

This project is part of my journey toward SDE-level backend engineering.

🧱 Modules Covered
✅ 1. Customers Module

Full CRUD

Search + pagination

Form Request validation

Unique email & phone constraints

Feature tests (authentication + validation + CRUD)

Factory-based test data

RefreshDatabase testing pattern

✔ Status: Completed with full feature test coverage

🔜 2. Products Module

SKU-based product management

Stock tracking

Soft deletes

Ownership (created_by)

Policy-based access control

Feature tests for CRUD + authorization

✔ Status: In Progress

🔜 3. Orders Module (Core System)

Planned features:

Create orders with multiple items

Transaction-safe order creation

Stock deduction logic

Prevent negative stock

Automatic total calculation

Stock logs (IN / OUT tracking)

Rollback on failure

Feature tests for:

Insufficient stock

Stock consistency

Order total validation

This module focuses on real backend engineering challenges.
