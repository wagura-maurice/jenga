INSERT INTO `users`(`name`, `user_account`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES ('SUPER ADMIN', 8, 'admin@jenga.co', '$2y$10$z6oJMfvH0kSAOWlCmQo7XOpaLSjGfPaDBwloW2edz64EzwgggiYQa', NULL, '2019-10-06 09:53:43', '2021-12-03 09:35:36');
INSERT INTO `users`(`name`, `user_account`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES ('ACCONTANT', 9, 'accontant@jenga.co', '$2y$10$z6oJMfvH0kSAOWlCmQo7XOpaLSjGfPaDBwloW2edz64EzwgggiYQa', NULL, '2020-08-07 10:59:25', '2021-01-03 20:31:45');
INSERT INTO `users`(`name`, `user_account`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES ('BDO', 3, 'bdo_officer@jenga.co', '$2y$10$z6oJMfvH0kSAOWlCmQo7XOpaLSjGfPaDBwloW2edz64EzwgggiYQa', NULL, '2020-01-28 09:49:19', '2020-01-28 09:49:19');
INSERT INTO `users`(`name`, `user_account`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES ('CREDIT ADMINISTRATOR', 1, 'credit_officer@jenga.co', '$2y$10$z6oJMfvH0kSAOWlCmQo7XOpaLSjGfPaDBwloW2edz64EzwgggiYQa', NULL, '2021-08-04 06:11:10', '2021-08-04 06:11:10');

INSERT INTO `loan_statuses`(`code`, `name`) VALUES ('004', 'Settled');

INSERT INTO `standing_order_categories`(`name`, `slug`, `created_at`) VALUES ('loan payment', 'loan+payment', '2023-01-25 17:12:54');

INSERT INTO `groups`(`group_number`, `group_name`) VALUES ('I0001', 'fictitious system group');