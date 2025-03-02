package com.example.bulb;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.ImageView;
import android.widget.ToggleButton;

import java.sql.RowId;

public class MainActivity extends AppCompatActivity {

    private ImageView imageView;
    private ToggleButton toggleButton;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        imageView=findViewById(R.id.imageView2);
        toggleButton=findViewById(R.id.toggle_btn);

        toggleButton.setOnCheckedChangeListener((buttonView,isChecked)->{
            if(isChecked){
                imageView.setImageResource(R.drawable.on);
            }
            else{
                imageView.setImageResource(R.drawable.off);
            }
        });

    }
}