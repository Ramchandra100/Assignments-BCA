package com.example.setb_2;

import android.os.Bundle;
import androidx.appcompat.app.AppCompatActivity;

import com.example.setb_2.DatabaseManager;
import com.example.setb_2.R;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        DatabaseManager dbManager = new DatabaseManager(MainActivity.this);

        // Add a new project
        dbManager.addProject("Project A", "Type 1", 12);

        // Add a new employee
        dbManager.addEmployee("John Doe", "Engineer", "2023-01-01");

        // Add a relationship between project and employee
        dbManager.addProjectEmployee(1, 1);
    }
}