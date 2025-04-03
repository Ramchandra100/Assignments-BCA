package com.tc.yourvehicle;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import androidx.activity.EdgeToEdge;
import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.auth.AuthResult;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.database.FirebaseDatabase;

public class SignupScreen extends AppCompatActivity {

    EditText email,pass,rePass;

    String pattern="[a-zA-Z0-9._-]+@[a-z]+\\.+[a-z]+";
    FirebaseAuth auth;
    FirebaseDatabase database;
    ProgressDialog progressDialog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_signup_screen);
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main), (v, insets) -> {
            Insets systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars());
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom);
            return insets;
        });
        Button signup,alreadyHave;
        signup=findViewById(R.id.login_button);
        alreadyHave=findViewById(R.id.dont_have_acc);
        rePass=findViewById(R.id.login_pass2);
        pass=findViewById(R.id.login_repass);
        email=findViewById(R.id.login_email);
        auth=FirebaseAuth.getInstance();
        database=FirebaseDatabase.getInstance();

        signup.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                String Email=email.getText().toString();
                String Pass=pass.getText().toString();

                auth.createUserWithEmailAndPassword(Email,Pass).addOnCompleteListener(new OnCompleteListener<AuthResult>() {
                    @Override
                    public void onComplete(@NonNull Task<AuthResult> task) {
                        if (task.isSuccessful()){
                            auth.getCurrentUser().sendEmailVerification().addOnCompleteListener(new OnCompleteListener<Void>() {
                                @Override
                                public void onComplete(@NonNull Task<Void> task) {
                                    Toast.makeText(SignupScreen.this,"done",Toast.LENGTH_SHORT).show();
                                }
                            });
//                                progressDialog.show();
//                                String id=task.getResult().getUser().getUid();
//                                DatabaseReference reference=database.getReference().child("user").child(id);
//                                startActivity(new Intent(Signup.this, MainScreen.class));
//                                finish();;
                        }
                    }
                });
                startActivity(new Intent(SignupScreen.this, MainActivity.class));
                finish();
            }
        });

        alreadyHave.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(SignupScreen.this,LoginScreen.class));
                finish();
            }
        });
    }
}