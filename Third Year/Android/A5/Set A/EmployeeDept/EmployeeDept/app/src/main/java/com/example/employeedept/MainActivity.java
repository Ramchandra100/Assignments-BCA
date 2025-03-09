package com.example.employeedept;

import android.os.Bundle;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity {
    private EditText editTextEmpName, editTextAddress, editTextPhone, editTextSalary, editTextDeptNo;
    private EditText editTextDeptName, editTextDeptLocation, editTextDeleteDept;
    private Button buttonAddEmp, buttonAddDept, buttonDeleteEmp;
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
        editTextEmpName = findViewById(R.id.editTextEmpName);
        editTextAddress = findViewById(R.id.editTextAddress);
        editTextPhone = findViewById(R.id.editTextPhone);
        editTextSalary = findViewById(R.id.editTextSalary);
        editTextDeptNo = findViewById(R.id.editTextDeptNo);

        editTextDeptName = findViewById(R.id.editTextDeptName);
        editTextDeptLocation = findViewById(R.id.editTextDeptLocation);
        editTextDeleteDept = findViewById(R.id.editTextDeleteDept);

        buttonAddEmp = findViewById(R.id.buttonAddEmp);
        buttonAddDept = findViewById(R.id.buttonAddDept);
        buttonDeleteEmp = findViewById(R.id.buttonDeleteEmp);

        textViewResult = findViewById(R.id.textViewResult);

        dbHelper = new DatabaseHelper(this);

        buttonAddEmp.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String name = editTextEmpName.getText().toString().trim();
                String address = editTextAddress.getText().toString().trim();
                String phone = editTextPhone.getText().toString().trim();
                String salaryStr = editTextSalary.getText().toString().trim();
                String deptNoStr = editTextDeptNo.getText().toString().trim();

                if (name.isEmpty() || address.isEmpty() || phone.isEmpty() || salaryStr.isEmpty() || deptNoStr.isEmpty()) {
                    textViewResult.setText("All fields are required!");
                    return;
                }

                try {
                    double salary = Double.parseDouble(salaryStr);
                    int deptNo = Integer.parseInt(deptNoStr);
                    dbHelper.insertEmp(name, address, phone, salary, deptNo);
                    textViewResult.setText("Employee added successfully!");
                } catch (NumberFormatException e) {
                    textViewResult.setText("Invalid input for salary or department number!");
                }
            }
        });

        buttonAddDept.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String name = editTextDeptName.getText().toString().trim();
                String location = editTextDeptLocation.getText().toString().trim();

                if (name.isEmpty() || location.isEmpty()) {
                    textViewResult.setText("All fields are required!");
                    return;
                }

                dbHelper.insertDept(name, location);
                textViewResult.setText("Department added successfully!");
            }
        });

        buttonDeleteEmp.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String deptName = editTextDeleteDept.getText().toString().trim();

                if (deptName.isEmpty()) {
                    textViewResult.setText("Department name is required!");
                    return;
                }

                dbHelper.deleteEmpByDeptName(deptName);
                textViewResult.setText("Employees deleted successfully!");
            }
        });
    }
}