-- Create the 'issues' table
CREATE TABLE issues (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,              -- Title of the issue
    description TEXT NOT NULL,                -- Detailed description of the issue
    priority VARCHAR(50) NOT NULL,            -- Priority level (Low, Medium, High)
    category VARCHAR(50) NOT NULL,            -- Issue category (Electrical, Mechanical, etc.)
    related_issue INT DEFAULT NULL,           -- Foreign key to another issue (optional)
    file_path VARCHAR(255),                   -- Path to the uploaded file or image
    reported_by VARCHAR(255) NOT NULL,        -- Name or ID of the user reporting the issue
    reported_date DATETIME NOT NULL,          -- Date and time of reporting
    FOREIGN KEY (related_issue) REFERENCES issues(id) ON DELETE SET NULL -- Related issue reference
);



INSERT INTO issues (title, description, priority, category, related_issue, reported_by, reported_date) VALUES
('Broken Track', 'Track is damaged near station A', 'High', 'Mechanical', NULL, 'staff_user', '2025-01-01 10:00:00'),
('Electrical Failure', 'Power outage in control room', 'Medium', 'Electrical', NULL, 'staff_user', '2025-01-02 14:30:00');