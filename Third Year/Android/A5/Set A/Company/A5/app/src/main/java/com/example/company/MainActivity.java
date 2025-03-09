package com.example.company;

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
    private EditText editTextName, editTextAddress, editTextPhno;
    private Button buttonInsert, buttonShow;
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
        editTextName = findViewById(R.id.editTextName);
        editTextAddress = findViewById(R.id.editTextAddress);
        editTextPhno = findViewById(R.id.editTextPhno);
        buttonInsert = findViewById(R.id.buttonInsert);
        buttonShow = findViewById(R.id.buttonShow);
        textViewResult = findViewById(R.id.textViewResult);

        dbHelper = new DatabaseHelper(this);

        buttonInsert.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String name = editTextName.getText().toString();
                String address = editTextAddress.getText().toString();
                String phno = editTextPhno.getText().toString();
                dbHelper.insertCompany(name, address, phno);
                textViewResult.setText("Company inserted successfully!");
            }
        });

        buttonShow.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Cursor cursor = dbHelper.getAllCompanies();
                StringBuilder result = new StringBuilder();
                while (cursor.moveToNext()) {
                    result.append("ID: ").append(cursor.getString(0)).append("\n");
                    result.append("Name: ").append(cursor.getString(1)).append("\n");
                    result.append("Address: ").append(cursor.getString(2)).append("\n");
                    result.append("Phone Number: ").append(cursor.getString(3)).append("\n\n");
                }
                cursor.close();
                textViewResult.setText(result.toString());
            }
        });
    }
}