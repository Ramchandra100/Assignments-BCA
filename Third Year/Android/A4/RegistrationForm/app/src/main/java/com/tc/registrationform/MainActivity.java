package com.tc.registrationform;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;
import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;
import androidx.fragment.app.DialogFragment;
public class MainActivity extends AppCompatActivity {
    private EditText etName, etEmail, etPassword, etAge, etMobile;
    private Button btnRegister;
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
        etName = findViewById(R.id.etName);
        etEmail = findViewById(R.id.etEmail);
        etPassword = findViewById(R.id.etPassword);
        etAge = findViewById(R.id.etAge);
        etMobile = findViewById(R.id.etMobile);
        btnRegister = findViewById(R.id.btnRegister);
        btnRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                registerUser();
            }
        });
    }
    private void registerUser() {
        String name = etName.getText().toString();
        String email = etEmail.getText().toString();
        String password = etPassword.getText().toString();
        String age = etAge.getText().toString();
        String mobile = etMobile.getText().toString();
        if (name.isEmpty()) {
            showMessage("Please enter your name.");
        } else if (!android.util.Patterns.EMAIL_ADDRESS.matcher(email).matches()) {
            showMessage("Please enter a valid email.");
        } else if (password.length() < 6) {
            showMessage("Password must be at least 6 characters.");
        } else if (age.isEmpty() || Integer.parseInt(age) < 18) {
            showMessage("Please enter a valid age.");
        } else if (mobile.isEmpty() || mobile.length() != 10) {
            showMessage("Please enter a valid mobile number.");
        } else {
            // Register user logic here
            Toast.makeText(this, "Registered successfully!", Toast.LENGTH_SHORT).show();
        }
    }
    private void showMessage(String message) {
        DialogFragment newFragment = ValidationDialogFragment.newInstance(message);
        newFragment.show(getSupportFragmentManager(), "dialog");
    }
}