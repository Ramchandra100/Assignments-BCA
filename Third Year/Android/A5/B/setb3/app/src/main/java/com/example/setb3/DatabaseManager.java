package com.example.setb3;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;

import java.util.ArrayList;
import java.util.List;

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

    public List<String> getEmployeesByProjectName(String projectName) {
        List<String> employeeList = new ArrayList<>();
        SQLiteDatabase db = dbHelper.getReadableDatabase();

        String[] columns = {
                DatabaseHelper.COLUMN_E_NAME,
                DatabaseHelper.COLUMN_QUALIFICATION,
                DatabaseHelper.COLUMN_JOINDATE
        };

        String[] selectionArgs = {projectName};

        Cursor cursor = db.rawQuery(
                "SELECT e." + DatabaseHelper.COLUMN_E_NAME + ", e." + DatabaseHelper.COLUMN_QUALIFICATION + ", e." + DatabaseHelper.COLUMN_JOINDATE +
                        " FROM " + DatabaseHelper.TABLE_EMPLOYEE + " e " +
                        " JOIN " + DatabaseHelper.TABLE_PROJECT_EMPLOYEE + " pe ON e." + DatabaseHelper.COLUMN_ID + " = pe." + DatabaseHelper.COLUMN_EMPLOYEE_ID +
                        " JOIN " + DatabaseHelper.TABLE_PROJECT + " p ON p." + DatabaseHelper.COLUMN_PNO + " = pe." + DatabaseHelper.COLUMN_PROJECT_ID +
                        " WHERE p." + DatabaseHelper.COLUMN_P_NAME + " = ?", selectionArgs);

        if (cursor != null && cursor.moveToFirst()) {
            do {
                String eName = cursor.getString(cursor.getColumnIndexOrThrow(DatabaseHelper.COLUMN_E_NAME));
                String qualification = cursor.getString(cursor.getColumnIndexOrThrow(DatabaseHelper.COLUMN_QUALIFICATION));
                String joinDate = cursor.getString(cursor.getColumnIndexOrThrow(DatabaseHelper.COLUMN_JOINDATE));
                employeeList.add("Name: " + eName + ", Qualification: " + qualification + ", Join Date: " + joinDate);
            } while (cursor.moveToNext());
        }

        if (cursor != null) {
            cursor.close();
        }
        db.close();
        return employeeList;
    }
}