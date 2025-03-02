package com.tc.intent;

import android.content.Intent;
import android.os.Bundle;
import android.widget.Button;
import android.widget.TextView;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

public class SecondActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_second);
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main), (v, insets) -> {
            Insets systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars());
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom);
            return insets;
        });
        TextView in,fn,ln,mn,dob,email,address;
        in=findViewById(R.id.in);
        fn=findViewById(R.id.tfn);
        ln=findViewById(R.id.tln);
        mn=findViewById(R.id.tmn);
        dob=findViewById(R.id.tdob);
        address=findViewById(R.id.taddress);
        email=findViewById(R.id.temail);
        Intent intent=getIntent();

        fn.setText("First Name : "+intent.getStringExtra("fn"));
        ln.setText("Last Name : "+intent.getStringExtra("ln"));
        mn.setText("Middle Name : "+intent.getStringExtra("mn"));
        address.setText("Adress : "+intent.getStringExtra("address"));
        email.setText("Email : "+intent.getStringExtra("email"));
        dob.setText("Date Of Birth : "+intent.getStringExtra("dob"));
        in.setText("INFORMATION");

    }
}