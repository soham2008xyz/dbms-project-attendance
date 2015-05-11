-- Tables
CREATE TABLE teachers (
	teacher_id NUMBER NOT NULL,
	teacher_code VARCHAR2(3) NOT NULL,
	teacher_name VARCHAR2(50) NOT NULL,
	teacher_email VARCHAR2(50),
	teacher_phone VARCHAR2(20),
	CONSTRAINT teacher_id_pkey PRIMARY KEY ( teacher_id )
);

CREATE TABLE subjects (
	subject_id NUMBER NOT NULL,
	subject_code VARCHAR2(6) NOT NULL,
	subject_name VARCHAR2(50) NOT NULL,
	CONSTRAINT subject_id_pkey PRIMARY KEY ( subject_id )
);

CREATE TABLE batches (
	batch_id NUMBER NOT NULL,
	batch_year_passout NUMBER NOT NULL,
	batch_stream VARCHAR2(25) NOT NULL,
	CONSTRAINT batch_id_pkey PRIMARY KEY ( batch_id )
);

CREATE TABLE sections (
	section_id NUMBER NOT NULL,
	batch_id NUMBER NOT NULL CONSTRAINT sections_batch_id_fkey REFERENCES batches(batch_id),
	section_name VARCHAR2(3) NOT NULL,
	CONSTRAINT section_id_pkey PRIMARY KEY ( section_id )
);

CREATE TABLE students (
	student_id NUMBER NOT NULL,
	section_id NUMBER NOT NULL CONSTRAINT students_section_id_fkey REFERENCES sections(section_id),
	student_name VARCHAR2(50) NOT NULL,
	student_email VARCHAR2(50),
	student_phone VARCHAR2(20),
	student_semester NUMBER NOT NULL,
	CONSTRAINT student_id_pkey PRIMARY KEY ( student_id )
);

CREATE TABLE schedules (
	schedule_id NUMBER NOT NULL,
	subject_id NUMBER NOT NULL CONSTRAINT schedules_subject_id_fkey REFERENCES subjects(subject_id),
	teacher_id NUMBER NOT NULL CONSTRAINT schedules_teacher_id_fkey REFERENCES teachers(teacher_id),
	section_id NUMBER NOT NULL CONSTRAINT schedules_section_id_fkey REFERENCES sections(section_id),
	schedule_weekday VARCHAR2(25) NOT NULL,
	schedule_period NUMBER NOT NULL,
	CONSTRAINT schedule_id_pkey PRIMARY KEY ( schedule_id )
);

CREATE TABLE attendance_records (
	attendance_record_id NUMBER NOT NULL,
	student_id NUMBER NOT NULL CONSTRAINT att_records_student_id_fkey REFERENCES students(student_id),
	schedule_id NUMBER NOT NULL CONSTRAINT att_records_schedule_id_fkey REFERENCES schedules(schedule_id),
	attendance_record_value NUMBER(1) DEFAULT 0,
	attendance_record_date DATE NOT NULL,
	CONSTRAINT attendance_id_pkey PRIMARY KEY ( attendance_record_id )
);

-- Sequences
CREATE SEQUENCE teachers_teacher_id_seq
	MINVALUE 1
	START WITH 1
	INCREMENT BY 1
	NOCACHE
;

CREATE SEQUENCE subjects_subject_id_seq
	MINVALUE 10
	START WITH 10
	INCREMENT BY 10
	NOCACHE
;

CREATE SEQUENCE batches_batch_id_seq
	MINVALUE 1
	START WITH 1
	INCREMENT BY 1
	NOCACHE
;

CREATE SEQUENCE sections_section_id_seq
	MINVALUE 1
	START WITH 1
	INCREMENT BY 1
	NOCACHE
;

CREATE SEQUENCE students_student_id_seq
	MINVALUE 1
	START WITH 1
	INCREMENT BY 1
	NOCACHE
;

CREATE SEQUENCE schedules_schedule_id_seq
	MINVALUE 1
	START WITH 1
	INCREMENT BY 1
	NOCACHE
;

CREATE SEQUENCE attendance_records_id_seq
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
		:new.teacher_id := teachers_teacher_id_seq.nextval;
	END;
/

CREATE OR REPLACE TRIGGER trig_subject_autoincrement
	BEFORE INSERT ON subjects
	FOR EACH ROW
	BEGIN
		:new.subject_id := subjects_subject_id_seq.nextval;
	END;
/

CREATE OR REPLACE TRIGGER trig_batch_autoincrement
	BEFORE INSERT ON batches
	FOR EACH ROW
	BEGIN
		:new.batch_id := batches_batch_id_seq.nextval;
	END;
/

CREATE OR REPLACE TRIGGER trig_section_autoincrement
	BEFORE INSERT ON sections
	FOR EACH ROW
	BEGIN
		:new.section_id := sections_section_id_seq.nextval;
	END;
/

CREATE OR REPLACE TRIGGER trig_student_autoincrement
	BEFORE INSERT ON students
	FOR EACH ROW
	BEGIN
		:new.student_id := students_student_id_seq.nextval;
	END;
/

CREATE OR REPLACE TRIGGER trig_schedule_autoincrement
	BEFORE INSERT ON schedules
	FOR EACH ROW
	BEGIN
		:new.schedule_id := schedules_schedule_id_seq.nextval;
	END;
/

CREATE OR REPLACE TRIGGER trig_att_record_autoincrement
	BEFORE INSERT ON attendance_records
	FOR EACH ROW
	BEGIN
		:new.attendance_record_id := attendance_records_id_seq.nextval;
	END;
/

-- Views
CREATE OR REPLACE VIEW all_class_routines AS
	SELECT
		schedules.section_id,
		schedules.schedule_weekday,
		schedules.schedule_period,
		sections.section_name,
		batches.batch_id,
		batches.batch_stream,
		subjects.subject_name,
		teachers.teacher_name
	FROM schedules
	INNER JOIN sections
		ON sections.section_id = schedules.section_id
	INNER JOIN batches
		ON batches.batch_id = sections.batch_id
	INNER JOIN subjects
		ON subjects.subject_id = schedules.subject_id
	INNER JOIN teachers
		ON teachers.teacher_id = schedules.teacher_id
WITH READ ONLY;

CREATE OR REPLACE VIEW all_teacher_routines AS
	SELECT
		schedules.teacher_id,
		schedules.schedule_weekday,
		schedules.schedule_period,
		teachers.teacher_name,
		subjects.subject_name,
		sections.section_name,
		batches.batch_id,
		batches.batch_stream
	FROM
		schedules
	INNER JOIN subjects
		ON schedules.subject_id = subjects.subject_id
	INNER JOIN sections
		ON schedules.section_id = sections.section_id
	INNER JOIN batches
		ON sections.batch_id = batches.batch_id
	INNER JOIN teachers
		ON schedules.teacher_id = teachers.teacher_id
WITH READ ONLY;

CREATE OR REPLACE VIEW attendance_list AS
	SELECT
		attendance_records.schedule_id,
		attendance_records.student_id,
		attendance_records.attendance_record_value,
		attendance_records.attendance_record_date,
		schedules.section_id,
		schedules.schedule_weekday,
		schedules.schedule_period,
		schedules.subject_id,
		subjects.subject_name,
		students.student_name,
		teachers.teacher_name
	FROM
		schedules
	INNER JOIN sections
		ON schedules.section_id = sections.section_id
	INNER JOIN subjects
		ON schedules.subject_id = subjects.subject_id
	INNER JOIN teachers
		ON schedules.teacher_id = teachers.teacher_id
	INNER JOIN attendance_records
		ON schedules.schedule_id = attendance_records.schedule_id
	INNER JOIN students
		ON attendance_records.student_id = students.student_id
WITH READ ONLY;

-- Procedures
CREATE OR REPLACE PROCEDURE add_teacher
	(
		teacher_code	teachers.teacher_code%type,
		teacher_name	teachers.teacher_name%type,
		teacher_email	teachers.teacher_email%type,
		teacher_phone	teachers.teacher_phone%type
	)
	IS
	BEGIN
		INSERT INTO teachers ( teacher_code, teacher_name, teacher_email, teacher_phone )
			VALUES ( teacher_code, teacher_name, teacher_email, teacher_phone );
	END;
/

CREATE OR REPLACE PROCEDURE add_subject
	(
		subject_code	subjects.subject_code%type,
		subject_name	subjects.subject_name%type
	)
	IS
	BEGIN
		INSERT INTO subjects ( subject_code, subject_name )
			VALUES ( subject_code, subject_name );
	END;
/

CREATE OR REPLACE PROCEDURE add_batch
	(
		batch_year_passout	batches.batch_year_passout%type,
		batch_stream				batches.batch_stream%type
	)
	IS
	BEGIN
		INSERT INTO batches ( batch_year_passout, batch_stream )
			VALUES ( batch_year_passout, batch_stream );
	END;
/

CREATE OR REPLACE PROCEDURE add_section
	(
		batch_id			sections.batch_id%type,
		section_name	sections.section_name%type
	)
	IS
	BEGIN
		INSERT INTO sections ( batch_id, section_name )
			VALUES ( batch_id, section_name );
	END;
/

CREATE OR REPLACE PROCEDURE add_student
	(
		section_id				students.section_id%type,
		student_name			students.student_name%type,
		student_email			students.student_email%type,
		student_phone			students.student_phone%type,
		student_semester	students.student_semester%type
	)
	IS
	BEGIN
		INSERT INTO students ( section_id, student_name, student_email, student_phone, student_semester )
			VALUES ( section_id, student_name, student_email, student_phone, student_semester );
	END;
/

CREATE OR REPLACE PROCEDURE add_schedule
	(
		subject_id				schedules.subject_id%type,
		teacher_id				schedules.teacher_id%type,
		section_id				schedules.section_id%type,
		schedule_weekday	schedules.schedule_weekday%type,
		schedule_period		schedules.schedule_period%type
	)
	IS
	BEGIN
		INSERT INTO schedules ( subject_id, teacher_id, section_id, schedule_weekday, schedule_period )
			VALUES ( subject_id, teacher_id, section_id,schedule_weekday, schedule_period );
	END;
/

CREATE OR REPLACE PROCEDURE add_attendance_record
	(
		student_id							attendance_records.student_id%type,
		schedule_id							attendance_records.schedule_id%type,
		attendance_record_value	attendance_records.attendance_record_value%type,
		attendance_record_date	attendance_records.attendance_record_date%type
	)
	IS
	BEGIN
	  INSERT INTO attendance_records ( student_id, schedule_id, attendance_record_value, attendance_record_date )
		VALUES ( student_id, schedule_id, attendance_record_value, attendance_record_date );
	END;
/

CREATE OR REPLACE PROCEDURE remove_teacher
	(
		teacher_id	teachers.teacher_id%type
	)
	IS
	BEGIN
		DELETE FROM teachers
		WHERE teacher_id = teacher_id;
	END;
/

CREATE OR REPLACE PROCEDURE remove_subject
	(
		subject_id	subjects.subject_id%type
	)
	IS
	BEGIN
		DELETE FROM subjects
		WHERE subject_id = subject_id;
	END;
/

CREATE OR REPLACE PROCEDURE remove_batch
	(
		batch_id	batches.batch_id%type
	)
	IS
	BEGIN
		DELETE FROM batches
		WHERE batch_id = batch_id;
	END;
/

CREATE OR REPLACE PROCEDURE remove_section
	(
		section_id	sections.section_id%type
	)
	IS
	BEGIN
		DELETE FROM sections
		WHERE section_id = section_id;
	END;
/

CREATE OR REPLACE PROCEDURE remove_schedule
	(
		schedule_id	schedules.schedule_id%type
	)
	IS
	BEGIN
		DELETE FROM schedules
		WHERE schedule_id = schedule_id;
	END;
/

CREATE OR REPLACE PROCEDURE remove_attendance_record
	(
		attendance_record_id	attendance_records.attendance_record_id%type
	)
	IS
	BEGIN
		DELETE FROM attendance_records
		WHERE attendance_record_id = attendance_record_id;
	END;
/