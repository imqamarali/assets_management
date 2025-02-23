        INSERT INTO public.employee (
            name, pic, sodowo, cnic, email, address, country, city, zip, job_discription, 
            department, designation, username, password, log_status, status, eobi, social, 
            usertype, salecenter, user_id, create_date, emis_id, gender, resign, resign_remarks, 
            resign_date, resign_attachment, cadre, scnic, user_level, doj, mobile, emp_code, 
            passport_no, emg_no1, emg_no2, b_group, religion, m_status, dob, permenant_address, 
            topadmin, nok_name, nok_relation, nok_phone, date_of_appointegerment, service_no, 
            prob_start, prob_end, expiry_of_contract, bank_name, account_title, account_number, 
            branch, whatsapp_no, desk_id
        ) VALUES 
            ('Admin User', NULL, NULL, NULL, 'admin@example.com', NULL, 1, 1, '12345', 'Admin Role', 
            1, 1, 'admin', 'password123', 0, 1, NULL, NULL, 'Admin', NULL, 1, NOW(), NULL, 1, 
            0, NULL, NULL, NULL, NULL, NULL, 1, NOW(), '1234567890', NULL, NULL, '9876543210', NULL, 'O+', 'Religion', 
            'Single', '1990-01-01', 'Permanent Address', 1, 'NOK Name', 'Relation', '0001112223', NOW(), 'SVC001', NOW(), NOW(), 
            NULL, 'Bank', 'Account Title', '123456789', 'Branch', '9998887777', NULL),

            ('RO User', NULL, NULL, NULL, 'ro@example.com', NULL, 1, 1, '12345', 'RO Role', 
            2, 2, 'ro', 'password123', 0, 1, NULL, NULL, 'RO', NULL, 2, NOW(), NULL, 1, 
            0, NULL, NULL, NULL, NULL, NULL, 2, NOW(), '1234567891', NULL, NULL, '9876543211', NULL, 'A+', 'Religion', 
            'Married', '1985-06-15', 'Permanent Address', 0, 'NOK Name', 'Relation', '0001112224', NOW(), 'SVC002', NOW(), NOW(), 
            NULL, 'Bank', 'Account Title', '123456780', 'Branch', '9998887778', NULL),

            ('ZONE User', NULL, NULL, NULL, 'zone@example.com', NULL, 1, 1, '12345', 'ZONE Role', 
            2, 3, 'zone', 'password123', 0, 1, NULL, NULL, 'ZONE', NULL, 3, NOW(), NULL, 1, 
            0, NULL, NULL, NULL, NULL, NULL, 3, NOW(), '1234567892', NULL, NULL, '9876543212', NULL, 'B+', 'Religion', 
            'Single', '1992-04-10', 'Permanent Address', 0, 'NOK Name', 'Relation', '0001112225', NOW(), 'SVC003', NOW(), NOW(), 
            NULL, 'Bank', 'Account Title', '123456781', 'Branch', '9998887779', NULL),

            ('RAMD User', NULL, NULL, NULL, 'ramd@example.com', NULL, 1, 1, '12345', 'RAMD Role', 
            4, 4, 'ramd', 'password123', 0, 1, NULL, NULL, 'RAMD', NULL, 4, NOW(), NULL, 1, 
            0, NULL, NULL, NULL, NULL, NULL, 4, NOW(), '1234567893', NULL, NULL, '9876543213', NULL, 'AB+', 'Religion', 
            'Married', '1988-09-20', 'Permanent Address', 0, 'NOK Name', 'Relation', '0001112226', NOW(), 'SVC004', NOW(), NOW(), 
            NULL, 'Bank', 'Account Title', '123456782', 'Branch', '9998887780', NULL),

            ('HO User', NULL, NULL, NULL, 'ho@example.com', NULL, 1, 1, '12345', 'HO Role', 
            5, 5, 'ho', 'password123', 0, 1, NULL, NULL, 'HO', NULL, 5, NOW(), NULL, 1, 
            0, NULL, NULL, NULL, NULL, NULL, 5, NOW(), '1234567894', NULL, NULL, '9876543214', NULL, 'O-', 'Religion', 
            'Single', '1995-12-05', 'Permanent Address', 0, 'NOK Name', 'Relation', '0001112227', NOW(), 'SVC005', NOW(), NOW(), 
            NULL, 'Bank', 'Account Title', '123456783', 'Branch', '9998887781', NULL);
