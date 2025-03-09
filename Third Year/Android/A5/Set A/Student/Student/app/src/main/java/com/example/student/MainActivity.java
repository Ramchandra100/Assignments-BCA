package com.example.student;

import android.database.Cursor;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

public class MainActivity extends AppCompatActivity {
    private EditText editTextTeacherName;
    private Button buttonSearch;
    private TextView textViewResult;
    private DatabaseHelper dbHelper;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_main);
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main), (v, insets) -> {
            Insets systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars());
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom);
            return insets;
        });
        editTextTeacherName = findViewById(R.id.editTextTeacherName);
        buttonSearch = findViewById(R.id.buttonSearch);
        textViewResult = findViewById(R.id.textViewResult);

        dbHelper = new DatabaseHelper(this);
        dbHelper.insertSampleData();

        buttonSearch.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String teacherName = editTextTeacherName.getText().toString();
                Cursor cursor = dbHelper.getStudentsByTeacherName(teacherName);
                StringBuilder result = new StringBuilder();
                while (cursor.moveToNext()) {
                    result.append("Student Name: ").append(cursor.getString(0)).append("\n");
                    result.append("Class: ").append(cursor.getString(1)).append("\n\n");
                }
                cursor.close();
                textViewResult.setText(result.toString());
            }
        });
    }
}