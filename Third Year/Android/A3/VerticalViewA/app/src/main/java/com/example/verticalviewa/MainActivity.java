package com.example.verticalviewa;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.ImageButton;
import android.widget.Toast;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        ImageButton b1 =findViewById(R.id.imageButton2);
        ImageButton b2=findViewById(R.id.imageButton3);

        b1.setOnClickListener(view -> {
            Toast.makeText(MainActivity.this,"First Button",Toast.LENGTH_SHORT).show();
        });

        b2.setOnClickListener(view -> {
            Toast.makeText(MainActivity.this,"Second Button",Toast.LENGTH_SHORT).show();
        });
    }
}