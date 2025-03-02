package com.example.listviewa;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        String[] fileNames={"file1.txt","file2.pdf","image.jpg","music.mp3","video.mp4","document.docx"};
        ListView listView=findViewById(R.id.list_view);
        ArrayAdapter<String> adapter=new ArrayAdapter<>(this, android.R.layout.simple_list_item_multiple_choice,fileNames);
        listView.setAdapter(adapter);
        listView.setChoiceMode(ListView.CHOICE_MODE_MULTIPLE);
        listView.setOnItemClickListener((parent,view,position,id)->{
            boolean isChecked=listView.isItemChecked(position);
            String message=(isChecked?"Selected : ":"Deselected : ")+fileNames[position];
            Toast.makeText(this, message, Toast.LENGTH_SHORT).show();
        });

    }
}