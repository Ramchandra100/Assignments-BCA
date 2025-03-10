package com.example.setb_2;

import android.content.ContentValues;
import android.content.Context;
import android.database.sqlite.SQLiteDatabase;

public class DatabaseManager {
    private DatabaseHelper dbHelper;

    public DatabaseManager(Context context) {
        dbHelper = new DatabaseHelper(context);
    }

    public void addProject(String pName, String pType, int duration) {
        SQLiteDatabase db = dbHelper.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put(DatabaseHelper.COLUMN_P_NAME, pName);
        values.put(DatabaseHelper.COLUMN_PTYPE, pType);
        values.put(DatabaseHelper.COLUMN_DURATION, duration);
        db.insert(DatabaseHelper.TABLE_PROJECT, null, values);
        db.close();
    }

    public void addEmployee(String eName, String qualification, String joinDate) {
        SQLiteDatabase db = dbHelper.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put(DatabaseHelper.COLUMN_E_NAME, eName);
        values.put(DatabaseHelper.COLUMN_QUALIFICATION, qualification);
        values.put(DatabaseHelper.COLUMN_JOINDATE, joinDate);
        db.insert(DatabaseHelper.TABLE_EMPLOYEE, null, values);
        db.close();
    }

    public void addProjectEmployee(int projectId, int employeeId) {
        SQLiteDatabase db = dbHelper.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put(DatabaseHelper.COLUMN_PROJECT_ID, projectId);
        values.put(DatabaseHelper.COLUMN_EMPLOYEE_ID, employeeId);
        db.insert(DatabaseHelper.TABLE_PROJECT_EMPLOYEE, null, values);
        db.close();
    }
}