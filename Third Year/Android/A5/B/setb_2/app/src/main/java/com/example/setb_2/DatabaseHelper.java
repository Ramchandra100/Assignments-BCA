package com.example.setb_2;

import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

public class DatabaseHelper extends SQLiteOpenHelper {

    private static final String DATABASE_NAME = "company.db";
    private static final int DATABASE_VERSION = 1;

    public static final String TABLE_PROJECT = "project";
    public static final String TABLE_EMPLOYEE = "employee";
    public static final String TABLE_PROJECT_EMPLOYEE = "project_employee";

    public static final String COLUMN_PNO = "pno";
    public static final String COLUMN_P_NAME = "p_name";
    public static final String COLUMN_PTYPE = "ptype";
    public static final String COLUMN_DURATION = "duration";

    public static final String COLUMN_ID = "id";
    public static final String COLUMN_E_NAME = "e_name";
    public static final String COLUMN_QUALIFICATION = "qualification";
    public static final String COLUMN_JOINDATE = "joindate";

    public static final String COLUMN_PROJECT_ID = "project_id";
    public static final String COLUMN_EMPLOYEE_ID = "employee_id";

    public DatabaseHelper(Context context) {
        super(context, DATABASE_NAME, null, DATABASE_VERSION);
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        String CREATE_PROJECT_TABLE = "CREATE TABLE " + TABLE_PROJECT + "("
                + COLUMN_PNO + " INTEGER PRIMARY KEY AUTOINCREMENT,"
                + COLUMN_P_NAME + " TEXT,"
                + COLUMN_PTYPE + " TEXT,"
                + COLUMN_DURATION + " INTEGER" + ")";

        String CREATE_EMPLOYEE_TABLE = "CREATE TABLE " + TABLE_EMPLOYEE + "("
                + COLUMN_ID + " INTEGER PRIMARY KEY AUTOINCREMENT,"
                + COLUMN_E_NAME + " TEXT,"
                + COLUMN_QUALIFICATION + " TEXT,"
                + COLUMN_JOINDATE + " TEXT" + ")";

        String CREATE_PROJECT_EMPLOYEE_TABLE = "CREATE TABLE " + TABLE_PROJECT_EMPLOYEE + "("
                + COLUMN_PROJECT_ID + " INTEGER,"
                + COLUMN_EMPLOYEE_ID + " INTEGER,"
                + "FOREIGN KEY(" + COLUMN_PROJECT_ID + ") REFERENCES " + TABLE_PROJECT + "(" + COLUMN_PNO + "),"
                + "FOREIGN KEY(" + COLUMN_EMPLOYEE_ID + ") REFERENCES " + TABLE_EMPLOYEE + "(" + COLUMN_ID + ")"
                + ")";

        db.execSQL(CREATE_PROJECT_TABLE);
        db.execSQL(CREATE_EMPLOYEE_TABLE);
        db.execSQL(CREATE_PROJECT_EMPLOYEE_TABLE);
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_PROJECT);
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_EMPLOYEE);
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_PROJECT_EMPLOYEE);
        onCreate(db);
    }
}