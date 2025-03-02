package com.tc.intent;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

public class MainActivity extends AppCompatActivity {

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
        Button b1=findViewById(R.id.button);
        EditText fn,mn,ln,address,dob,email;
        fn=findViewById(R.id.fn);
        ln=findViewById(R.id.ln);
        mn=findViewById(R.id.mn);
        address=findViewById(R.id.address);
        dob=findViewById(R.id.dob);
        email=findViewById(R.id.email);

        b1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent=new Intent(MainActivity.this, SecondActivity.class);
                intent.putExtra("fn",fn.getText().toString());
                intent.putExtra("mn",mn.getText().toString());
                intent.putExtra("ln",ln.getText().toString());
                intent.putExtra("dob",dob.getText().toString());
                intent.putExtra("address",address.getText().toString());
                intent.putExtra("email",email.getText().toString());
                startActivity(intent);
            }
        });
    }
}