-- Tables
CREATE TABLE teachers (
	t_id NUMBER NOT NULL,
	t_code VARCHAR2(3) NOT NULL,
	t_name VARCHAR2(50) NOT NULL,
	email VARCHAR2(50) , 
	phone VARCHAR2(20),
	CONSTRAINT teacher_id_pk PRIMARY KEY ( t_id )
);

CREATE TABLE subjects (
	sub_id NUMBER NOT NULL,
	sub_name VARCHAR2(25) NOT NULL,
	CONSTRAINT subject_id_pk PRIMARY KEY ( sub_id )
);

CREATE TABLE batches (
	b_id NUMBER NOT NULL,
	b_year_passout NUMBER NOT NULL,
	b_stream VARCHAR2(25) NOT NULL,
	CONSTRAINT batch_id_pk PRIMARY KEY ( b_id )
);

CREATE TABLE sections (
	sec_id NUMBER NOT NULL,
	sec_batch_id NUMBER NOT NULL CONSTRAINT batch_id_fkey REFERENCES batches(b_id),
	sec_letter VARCHAR(3) NOT NULL,
	sec_year NUMBER,
	CONSTRAINT section_id_pk PRIMARY KEY ( sec_id )
);

CREATE TABLE students (
	s_id NUMBER NOT NULL,
	s_section_id NUMBER NOT NULL CONSTRAINT section_id_fkey REFERENCES sections(sec_id),
	s_semester NUMBER NOT NULL,
	s_name VARCHAR2(50) NOT NULL,
	s_email VARCHAR2(50) , 
	s_phone VARCHAR2(20),
	CONSTRAINT student_id_pk PRIMARY KEY ( s_id )
);

CREATE TABLE schedules (
	sch_id NUMBER NOT NULL,
	sch_subject_id NUMBER NOT NULL CONSTRAINT subject_id_fkey REFERENCES subjects(sub_id),
	sch_teacher_id NUMBER NOT NULL CONSTRAINT teacher_id_fkey REFERENCES teachers(t_id),
	sch_section_id NUMBER NOT NULL CONSTRAINT section_id_fkey2 REFERENCES sections(sec_id),
	sch_week_day VARCHAR2(25) NOT NULL,
	sch_period NUMBER NOT NULL, 
	CONSTRAINT schedule_id_pk PRIMARY KEY ( sch_id )
);

CREATE TABLE attendance_records (
	atten_id NUMBER NOT NULL,
	atten_student_id NUMBER NOT NULL CONSTRAINT student_id_fkey REFERENCES students(s_id),
	atten_schedule_id NUMBER NOT NULL CONSTRAINT schedule_id_fkey REFERENCES schedules(sch_id),
	atten_attended NUMBER(1) DEFAULT 0,
	atten_date DATE NOT NULL,
	CONSTRAINT attendance_id_pk PRIMARY KEY ( atten_id )
);

-- Sequences
CREATE SEQUENCE teachers_t_id_seq 
	MINVALUE 1 
	START WITH 1
	INCREMENT BY 1
	NOCACHE 
;

CREATE SEQUENCE subjects_sub_id_seq 
	MINVALUE 10 
	START WITH 10
	INCREMENT BY 10
	NOCACHE 
;

CREATE SEQUENCE batches_b_id_seq 
	MINVALUE 1 
	START WITH 1
	INCREMENT BY 1
	NOCACHE 
;

CREATE SEQUENCE sections_sec_id_seq 
	MINVALUE 1 
	START WITH 1
	INCREMENT BY 1
	NOCACHE 
;

CREATE SEQUENCE students_s_id_seq 
	MINVALUE 1 
	START WITH 1
	INCREMENT BY 1
	NOCACHE 
;

CREATE SEQUENCE schedules_sch_id_seq 
	MINVALUE 1 
	START WITH 1
	INCREMENT BY 1
	NOCACHE 
;

CREATE SEQUENCE atten_id_seq 
	MINVALUE 1 
	START WITH 1
	INCREMENT BY 1
	NOCACHE 
;

-- Triggers	
CREATE OR REPLACE TRIGGER trig_teacher_autoincrement
	BEFORE INSERT ON teachers
	FOR EACH ROW
	BEGIN
		:new.t_id := teachers_t_id_seq.nextval;
	END;
/

CREATE OR REPLACE TRIGGER trig_subject_autoincrement
	BEFORE INSERT ON subjects
	FOR EACH ROW
	BEGIN
		:new.sub_id := subjects_sub_id_seq.nextval;
	END;
/

CREATE OR REPLACE TRIGGER trig_batch_autoincrement
	BEFORE INSERT ON batches
	FOR EACH ROW
	BEGIN
		:new.b_id := batches_b_id_seq.nextval;
	END;
/

CREATE OR REPLACE TRIGGER trig_section_autoincrement
	BEFORE INSERT ON sections
	FOR EACH ROW
	BEGIN
		:new.sec_id := sections_sec_id_seq.nextval;
	END;
/

CREATE OR REPLACE TRIGGER trig_student_autoincrement
	BEFORE INSERT ON students
	FOR EACH ROW
	BEGIN
		:new.s_id := students_s_id_seq.nextval;
	END;
/

CREATE OR REPLACE TRIGGER trig_schedule_autoincrement
	BEFORE INSERT ON schedules
	FOR EACH ROW
	BEGIN
		:new.sch_id := schedules_sch_id_seq.nextval;
	END;
/

CREATE OR REPLACE TRIGGER trig_a_record_autoincrement
	BEFORE INSERT ON attendance_records
	FOR EACH ROW
	BEGIN
		:new.atten_id := atten_id_seq.nextval;
	END;
/

-- Views
CREATE OR REPLACE VIEW class_routine AS
SELECT
schedules.sch_id,
schedules.sch_week_day,
schedules.sch_period,
sections.sec_letter,
batches.b_id,
batches.b_stream,
subjects.sub_name,
teachers.t_name
FROM
schedules,
sections,
subjects,
batches,
teachers
WHERE sections.sec_id = schedules.sch_section_id
AND subjects.sub_id = schedules.sch_subject_id
AND teachers.t_id = schedules.sch_teacher_id
AND batches.b_id = sections.sec_batch_id
WITH READ ONLY;

CREATE OR REPLACE VIEW teacher_routine AS
SELECT
schedules.sch_teacher_id,
schedules.sch_week_day,
schedules.sch_period,
teachers.t_name,
subjects.sub_name,
sections.sec_year,
sections.sec_letter,
batches.b_stream
FROM
schedules,
subjects,
batches,
teachers,
sections
WHERE schedules.sch_teacher_id = teachers.t_id
AND subjects.sub_id = schedules.sch_subject_id
AND schedules.sch_section_id = sections.sec_id
AND batches.b_id = sections.sec_batch_id
WITH READ ONLY;

CREATE OR REPLACE VIEW attendance_list AS
SELECT
attendance_records.atten_schedule_id,
schedules.sch_section_id,
schedules.sch_week_day,
schedules.sch_period,
schedules.sch_subject_id,
subjects.sub_name,
students.s_name as student_name,
teachers.t_name,
attendance_records.atten_student_id,
attendance_records.atten_attended,
attendance_records.atten_date
FROM
schedules,
sections,
subjects,
teachers,
attendance_records,
students
WHERE attendance_records.atten_schedule_id = schedules.sch_id
AND attendance_records.atten_student_id = students.s_id
AND sections.sec_id = schedules.sch_section_id
AND subjects.sub_id = schedules.sch_subject_id
AND teachers.t_id = schedules.sch_teacher_id
WITH READ ONLY;

-- Procedures
CREATE OR REPLACE PROCEDURE add_teacher
	( 
		p_t_code	teachers.t_code%type,
		p_t_name	teachers.t_name%type,
		p_email   	teachers.email%type,
		p_phone   	teachers.phone%type
	)
	IS
	BEGIN
		INSERT INTO teachers (t_code, t_name, t_email, t_phone)
			VALUES (p_t_code, p_t_name, p_email, p_phone);
	END;
/

CREATE OR REPLACE PROCEDURE add_subject
	( 
		p_s_name   subjects.s_name%type
	)
	IS
	BEGIN
		INSERT INTO subjects (sub_name)
			VALUES (p_s_name);
	END;
/

CREATE OR REPLACE PROCEDURE add_batch
	(
		p_year_passout	batches.b_year_passout%type,
		p_stream		batches.b_stream%type
	)
	IS
	BEGIN
		INSERT INTO batches(b_year_passout,b_stream)
			VALUES(p_year_passout,p_stream);
	END;
/

CREATE OR REPLACE PROCEDURE add_section
	(
		p_batch_id		sections.sec_batch_id%type,
		p_sec_letter	sections.sec_letter%type,
	)
	IS
	BEGIN
		INSERT INTO sections(sec_batch_id,sec_letter)
			VALUES(p_batch_id,p_sec_letter);
	END;
/

CREATE OR REPLACE PROCEDURE add_student
	( 
		p_section_id   	students.s_section_id%type,
		p_semester   	students.s_semester%type,	
		p_s_name   		students.s_name%type,
		p_s_email   	students.s_email%type,
		p_s_phone   	students.s_phone%type
	)
	IS
	BEGIN
		INSERT INTO students (s_section_id, s_name, s_email, s_phone, s_semester)
			VALUES (p_section_id, p_s_name, p_email, p_phone, p_semester);
	END;
/

CREATE OR REPLACE PROCEDURE add_schedule
	(
		p_teacher_id  	schedules.sch_teacher_id%type,
		p_section_id   	schedules.sch_section_id%type,
		p_subject_id   	schedules.sch_subject_id%type,
		p_week_day		schedules.sch_week_day%type,
		p_period  		schedules.sch_period%type
	)
	IS
	BEGIN
		INSERT INTO schedules (sch_subject_id, sch_teacher_id, sch_section_id, sch_week_day, sch_period)
			VALUES (p_subject_id, p_teacher_id, p_section_id, p_week_day, p_period);
	END;
/

CREATE OR REPLACE PROCEDURE add_attendance_record
	( 
		p_student_id	attendance_records.atten_student_id%type,
		p_schedule_id	attendance_records.atten_schedule_id%type,
		p_attended		attendance_records.atten_attended%type,
		p_a_date   		attendance_records.atten_date%type
	)
	IS
	BEGIN
	  INSERT INTO attendance_records (atten_student_id, atten_schedule_id, atten_attended, atten_date)
		VALUES (p_student_id, p_schedule_id, p_attended, p_a_date);
	END;
/

CREATE OR REPLACE PROCEDURE view_class_routine
	( 
		p_s_letter   attendance_records.student_id%type,
		p_schedule_id   attendance_records.schedule_id%type,
		p_attended   attendance_records.attended%type,
		p_a_date   attendance_records.a_date%type
	)
	IS
	BEGIN
	  INSERT INTO attendance_records(student_id,schedule_id,attended,a_date)
		VALUES(p_student_id,p_schedule_id,p_attended,p_a_date);
	END;
/