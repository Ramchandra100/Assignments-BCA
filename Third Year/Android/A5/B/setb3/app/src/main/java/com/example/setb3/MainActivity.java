package com.example.setb3;

import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import androidx.appcompat.app.AppCompatActivity;

import com.example.setb3.DatabaseManager;

import java.util.List;

public class MainActivity extends AppCompatActivity {

    private EditText projectNameInput;
    private Button searchButton;
    private TextView resultTextView;
    private DatabaseManager dbManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        projectNameInput = findViewById(R.id.projectNameInput);
        searchButton = findViewById(R.id.searchButton);
        resultTextView = findViewById(R.id.resultTextView);

        dbManager = new DatabaseManager(this);

        // Add some sample data for testing
        dbManager.addProject("Project A", "Type 1", 12);
        dbManager.addEmployee("John Doe", "Engineer", "2023-01-01");
        dbManager.addEmployee("Jane Smith", "Designer", "2023-02-01");
        dbManager.addProjectEmployee(1, 1);
        dbManager.addProjectEmployee(1, 2);

        searchButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String projectName = projectNameInput.getText().toString();
                List<String> employees = dbManager.getEmployeesByProjectName(projectName);
                StringBuilder result = new StringBuilder();
                if (employees.isEmpty()) {
                    result.append("No employees found for the project.");
                } else {
                    for (String employee : employees) {
                        result.append(employee).append("\n");
                    }
                }
                resultTextView.setText(result.toString());
            }
        });
    }
}