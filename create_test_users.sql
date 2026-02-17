-- Create test users in xin_employees table for login testing
-- Password for all: test123 (hashed)

INSERT INTO `xin_employees` (
    `user_id`, `employee_id`, `office_shift_id`, `first_name`, `last_name`, 
    `username`, `email`, `password`, `date_of_birth`, `gender`, `e_status`, 
    `user_role_id`, `department_id`, `sub_department_id`, `designation_id`, 
    `company_id`, `salary_template`, `hourly_grade_id`, `monthly_grade_id`, 
    `date_of_joining`, `date_of_leaving`, `marital_status`, `salary`, 
    `wages_type`, `basic_salary`, `daily_wages`, `salary_ssempee`, 
    `salary_ssempeer`, `salary_income_tax`, `salary_overtime`, 
    `salary_commission`, `salary_claims`, `salary_paid_leave`, 
    `salary_director_fees`, `salary_bonus`, `salary_advance_paid`, 
    `address`, `profile_picture`, `profile_background`, `resume`, 
    `skype_id`, `contact_no`, `facebook_link`, `twitter_link`, 
    `blogger_link`, `linkdedin_link`, `google_plus_link`, 
    `instagram_link`, `pinterest_link`, `youtube_link`, `is_active`, 
    `last_login_date`, `last_logout_date`, `last_login_ip`, 
    `is_logged_in`, `online_status`, `fixed_header`, 
    `compact_sidebar`, `boxed_wrapper`, `leave_categories`, `created_at`
) VALUES
(100, 'admin001', 1, 'Test', 'Admin', 'admin', 'test1@test.com', 
 '$2y$12$OIbneZbW12PufunCwz1xEekd6ilPFj218eR.WfoNazJ6AUgr10F3G', 
 '1990-01-01', 'Male', 0, 1, 1, 8, 9, 1, 'monthly', 0, 0, 
 CURDATE(), '', 'Single', '', 1, '1000', '0', '8', '17', '10', 
 '0', '1', '2', '3', '0', '0', '0', 'Test Address', '', '', '', 
 '', '1234567890', '', '', '', '', '', '', '', '', 1, 
 NOW(), '', '127.0.0.1', 0, 1, 'fixed_layout_hrsale', '', '', 
 '0,1,2', NOW()),
-- User 2: test@test.com / test / test123  
(101, 'test001', 1, 'Test', 'User', 'test', 'test@test.com', 
 '$2y$12$OIbneZbW12PufunCwz1xEekd6ilPFj218eR.WfoNazJ6AUgr10F3G', 
 '1990-01-01', 'Male', 0, 2, 2, 10, 10, 1, 'monthly', 0, 0, 
 CURDATE(), '', 'Single', '', 1, '2000', '0', '0', '0', '0', 
 '0', '0', '0', '0', '0', '0', '0', 'Test Address', '', '', '', 
 '', '1234567890', '', '', '', '', '', '', '', '', 1, 
 NOW(), '', '127.0.0.1', 0, 1, '', '', '', '0,1,2', NOW()),
-- User 3: employer@test.com / (no username) / test123
(102, 'emp001', 1, 'Employer', 'Test', '', 'employer@test.com', 
 '$2y$12$OIbneZbW12PufunCwz1xEekd6ilPFj218eR.WfoNazJ6AUgr10F3G', 
 '1990-01-01', 'Male', 0, 1, 1, 8, 9, 1, 'monthly', 0, 0, 
 CURDATE(), '', 'Single', '', 1, '1000', '0', '8', '17', '10', 
 '0', '1', '2', '3', '0', '0', '0', 'Test Address', '', '', '', 
 '', '1234567890', '', '', '', '', '', '', '', '', 1, 
 NOW(), '', '127.0.0.1', 0, 1, 'fixed_layout_hrsale', '', '', 
 '0,1,2', NOW())
ON DUPLICATE KEY UPDATE 
    email=VALUES(email), 
    password=VALUES(password), 
    is_active=1;

