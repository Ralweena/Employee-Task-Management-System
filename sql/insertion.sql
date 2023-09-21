/* ---- Inserting values to admin table ---- */

INSERT INTO ADMIN_MANAGER (admin_name, admin_email, admin_phone, admin_gender, admin_pass) VALUES ('ABC','abc@gmail.com', "9759843243", 'Male', '$2y$10$JqQATS3B4R4y3hFLDx8Lkuz01WlZ573ZJeC/pbLNSXXjeEIMGETbu');
INSERT INTO ADMIN_MANAGER (admin_name, admin_email, admin_phone, admin_gender, admin_pass) VALUES ('XYZ','xyz@gmail.com', "8754092145", 'Male', '$2y$10$JqQATS3B4R4y3hFLDx8Lkuz01WlZ573ZJeC/pbLNSXXjeEIMGETbu');
INSERT INTO ADMIN_MANAGER (admin_name, admin_email, admin_phone, admin_gender, admin_pass) VALUES ('XXX','xxx@gmail.com', "6704532161", 'Female', '$2y$10$JqQATS3B4R4y3hFLDx8Lkuz01WlZ573ZJeC/pbLNSXXjeEIMGETbu');

/* ---- Inserting values to manager table ----- */

INSERT INTO DEPARTMENT (dept_name, admin_id) VALUES ('Accounts',1);
INSERT INTO DEPARTMENT (dept_name, admin_id) VALUES ('Sales',2);
INSERT INTO DEPARTMENT (dept_name, admin_id) VALUES ('HR',1);