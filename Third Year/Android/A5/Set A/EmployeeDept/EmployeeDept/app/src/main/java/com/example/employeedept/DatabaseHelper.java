package com.example.employeedept;
import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

public class DatabaseHelper extends SQLiteOpenHelper {

    private static final String DATABASE_NAME = "CompanyDB";
    private static final int DATABASE_VERSION = 1;
    private static final String TABLE_EMP = "Emp";
    private static final String TABLE_DEPT = "Dept";

    private static final String COLUMN_EMP_NO = "emp_no";
    private static final String COLUMN_EMP_NAME = "emp_name";
    private static final String COLUMN_ADDRESS = "address";
    private static final String COLUMN_PHONE = "phone";
    private static final String COLUMN_SALARY = "salary";
    private static final String COLUMN_DEPT_NO = "dept_no";

    private static final String COLUMN_DEPT_NO_DEPT = "dept_no";
    private static final String COLUMN_DEPT_NAME = "dept_name";
    private static final String COLUMN_LOCATION = "location";

    private static final String CREATE_TABLE_EMP = "CREATE TABLE " + TABLE_EMP + " (" +
            COLUMN_EMP_NO + " INTEGER PRIMARY KEY AUTOINCREMENT, " +
            COLUMN_EMP_NAME + " TEXT, " +
            COLUMN_ADDRESS + " TEXT, " +
            COLUMN_PHONE + " TEXT, " +
            COLUMN_SALARY + " REAL, " +
            COLUMN_DEPT_NO + " INTEGER, " +
            "FOREIGN KEY (" + COLUMN_DEPT_NO + ") REFERENCES " + TABLE_DEPT + "(" + COLUMN_DEPT_NO_DEPT + "))";

    private static final String CREATE_TABLE_DEPT = "CREATE TABLE " + TABLE_DEPT + " (" +
            COLUMN_DEPT_NO_DEPT + " INTEGER PRIMARY KEY AUTOINCREMENT, " +
            COLUMN_DEPT_NAME + " TEXT, " +
            COLUMN_LOCATION + " TEXT)";

    public DatabaseHelper(Context context) {
        super(context, DATABASE_NAME, null, DATABASE_VERSION);
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        db.execSQL(CREATE_TABLE_DEPT);
        db.execSQL(CREATE_TABLE_EMP);
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_EMP);
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_DEPT);
        onCreate(db);
    }

    public void insertEmp(String name, String address, String phone, double salary, int deptNo) {
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put(COLUMN_EMP_NAME, name);
        values.put(COLUMN_ADDRESS, address);
        values.put(COLUMN_PHONE, phone);
        values.put(COLUMN_SALARY, salary);
        values.put(COLUMN_DEPT_NO, deptNo);
        db.insert(TABLE_EMP, null, values);
        db.close();
    }

    public void insertDept(String name, String location) {
        SQLiteDatabase db = this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put(COLUMN_DEPT_NAME, name);
        values.put(COLUMN_LOCATION, location);
        db.insert(TABLE_DEPT, null, values);
        db.close();
    }

    public void deleteEmpByDeptName(String deptName) {
        SQLiteDatabase db = this.getWritableDatabase();
        String query = "SELECT " + COLUMN_DEPT_NO_DEPT + " FROM " + TABLE_DEPT + " WHERE " + COLUMN_DEPT_NAME + " = ?";
        Cursor cursor = db.rawQuery(query, new String[]{deptName});
        if (cursor.moveToFirst()) {
            int deptNo = cursor.getInt(0);
            db.delete(TABLE_EMP, COLUMN_DEPT_NO + " = ?", new String[]{String.valueOf(deptNo)});
        }
        cursor.close();
        db.close();
    }
}