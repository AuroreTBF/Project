CREATE TABLE Transactions (
    transaction_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    amount DECIMAL(10, 2),
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50),
    payment_method int(50),
    FOREIGN KEY (shop_id) REFERENCES shopping_cart(Shopping_cart_id),
    FOREIGN KEY (payment_method) REFERENCES PaymentMethods(Payment_Method_id)
);
CREATE TABLE PaymentMethods (
    Payment_Method_id INT PRIMARY KEY,
    Payment_Method_Description VARCHAR(50)
);
CREATE TABLE DebitPayment (
    Payment_id INT PRIMARY KEY,
    Payment_Method_id INT,
    payment_amount DECIMAL(18, 2),
    FOREIGN KEY (Payment_Method_id) REFERENCES PaymentMethods(Payment_Method_id)
);
CREATE TABLE CashPaymentDetails (
    cash_id INT PRIMARY KEY,
    payment_id INT,
    cash_amount DECIMAL(18, 2),
    FOREIGN KEY (payment_id) REFERENCES PaymentMethods(Payment_id)
);
CREATE TABLE PaypalDetails (
    paypal_id INT PRIMARY KEY,
    payment_id INT,
    total_amount DECIMAL(18, 2),
    FOREIGN KEY (payment_id) REFERENCES PaymentMethods(Payment_id)
);

ALTER TABLE `debitpayment` CHANGE `Payment_id` `debit_id` INT(11) NOT NULL, CHANGE `Payment_Method_id` `payment_id` INT(11) NULL DEFAULT NULL, CHANGE `payment_amount` `total_amount` DECIMAL(18,2) NULL DEFAULT NULL;
ALTER TABLE `cashpaymentdetails` CHANGE `cash_amount` `total_amount` DECIMAL(18,2) NULL DEFAULT NULL;
