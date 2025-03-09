package com.example.student;
import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

public class DatabaseHelper extends SQLiteOpenHelper {

    private static final String DATABASE_NAME = "SchoolDB";
    private static final int DATABASE_VERSION = 1;
    private static final String TABLE_STUDENT = "Student";
    private static final String TABLE_TEACHER = "Teacher";
    private static final String TABLE_STUDENT_TEACHER = "StudentTeacher";

    private static final String COLUMN_SNO = "sno";
    private static final String COLUMN_S_NAME = "s_name";
    private static final String COLUMN_S_CLASS = "s_class";
    private static final String COLUMN_S_ADDR = "s_addr";

    private static final String COLUMN_TNO = "tno";
    private static final String COLUMN_T_NAME = "t_name";
    private static final String COLUMN_QUALIFICATION = "qualification";
    private static final String COLUMN_EXPERIENCE = "experience";

    private static final String COLUMN_ST_SNO = "st_sno";
    private static final String COLUMN_ST_TNO = "st_tno";

    private static final String CREATE_TABLE_STUDENT = "CREATE TABLE " + TABLE_STUDENT + " (" +
            COLUMN_SNO + " INTEGER PRIMARY KEY AUTOINCREMENT, " +
            COLUMN_S_NAME + " TEXT, " +
            COLUMN_S_CLASS + " TEXT, " +
            COLUMN_S_ADDR + " TEXT)";

    private static final String CREATE_TABLE_TEACHER = "CREATE TABLE " + TABLE_TEACHER + " (" +
            COLUMN_TNO + " INTEGER PRIMARY KEY AUTOINCREMENT, " +
            COLUMN_T_NAME + " TEXT, " +
            COLUMN_QUALIFICATION + " TEXT, " +
            COLUMN_EXPERIENCE + " TEXT)";

    private static final String CREATE_TABLE_STUDENT_TEACHER = "CREATE TABLE " + TABLE_STUDENT_TEACHER + " (" +
            COLUMN_ST_SNO + " INTEGER, " +
            COLUMN_ST_TNO + " INTEGER, " +
            "PRIMARY KEY (" + COLUMN_ST_SNO + ", " + COLUMN_ST_TNO + "), " +
            "FOREIGN KEY (" + COLUMN_ST_SNO + ") REFERENCES " + TABLE_STUDENT + "(" + COLUMN_SNO + "), " +
            "FOREIGN KEY (" + COLUMN_ST_TNO + ") REFERENCES " + TABLE_TEACHER + "(" + COLUMN_TNO + "))";

    public DatabaseHelper(Context context) {
        super(context, DATABASE_NAME, null, DATABASE_VERSION);
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        db.execSQL(CREATE_TABLE_STUDENT);
        db.execSQL(CREATE_TABLE_TEACHER);
        db.execSQL(CREATE_TABLE_STUDENT_TEACHER);
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_STUDENT_TEACHER);
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_TEACHER);
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_STUDENT);
        onCreate(db);
    }

    public void insertStudent(String name, String sclass, String address) {
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put(COLUMN_S_NAME, name);
        values.put(COLUMN_S_CLASS, sclass);
        values.put(COLUMN_S_ADDR, address);
        db.insert(TABLE_STUDENT, null, values);
        db.close();
    }

    public void insertTeacher(String name, String qualification, String experience) {
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put(COLUMN_T_NAME, name);
        values.put(COLUMN_QUALIFICATION, qualification);
        values.put(COLUMN_EXPERIENCE, experience);
        db.insert(TABLE_TEACHER, null, values);
        db.close();
    }

    public void insertStudentTeacher(int sno, int tno) {
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put(COLUMN_ST_SNO, sno);
        values.put(COLUMN_ST_TNO, tno);
        db.insert(TABLE_STUDENT_TEACHER, null, values);
        db.close();
    }

    public Cursor getStudentsByTeacherName(String teacherName) {
        SQLiteDatabase db = this.getReadableDatabase();
        String query = "SELECT s." + COLUMN_S_NAME + ", s." + COLUMN_S_CLASS +
                " FROM " + TABLE_STUDENT + " s " +
                "JOIN " + TABLE_STUDENT_TEACHER + " st ON s." + COLUMN_SNO + " = st." + COLUMN_ST_SNO +
                " JOIN " + TABLE_TEACHER + " t ON t." + COLUMN_TNO + " = st." + COLUMN_ST_TNO +
                " WHERE t." + COLUMN_T_NAME + " = ?";
        return db.rawQuery(query, new String[]{teacherName});
    }

    public void insertSampleData() {
        SQLiteDatabase db = this.getWritableDatabase();

        // Insert sample students
        insertStudent("John Doe", "10A", "123 Main St");
        insertStudent("Jane Smith", "10B", "456 Elm St");
        insertStudent("Alice Johnson", "11A", "789 Oak St");

        // Insert sample teachers
        insertTeacher("Mr. Brown", "Masters", "5 years");
        insertTeacher("Mrs. Green", "PhD", "10 years");

        // Insert sample student-teacher relationships
        insertStudentTeacher(1, 1); // John Doe - Mr. Brown
        insertStudentTeacher(2, 1); // Jane Smith - Mr. Brown
        insertStudentTeacher(3, 2); // Alice Johnson - Mrs. Green

        db.close();
    }
}