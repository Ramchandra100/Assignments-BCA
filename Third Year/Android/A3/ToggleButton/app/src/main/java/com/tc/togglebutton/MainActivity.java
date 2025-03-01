package com.tc.togglebutton;

import androidx.appcompat.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.ImageView;
import android.widget.ToggleButton;

public class MainActivity extends AppCompatActivity {

    private ImageView lightBulbImageView;
    private ToggleButton toggleButton;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        lightBulbImageView = findViewById(R.id.lightBulbImageView);
        toggleButton = findViewById(R.id.toggleButton);

        // Set initial state of the light bulb
        lightBulbImageView.setImageResource(R.drawable.off_b);

        // Set up the toggle button listener
        toggleButton.setOnCheckedChangeListener((buttonView, isChecked) -> {
            if (isChecked) {
                // Light is on
                lightBulbImageView.setImageResource(R.drawable.on_b);
            } else {
                // Light is off
                lightBulbImageView.setImageResource(R.drawable.off_b);
            }
        });
    }
}