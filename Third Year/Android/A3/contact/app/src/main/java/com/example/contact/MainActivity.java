package com.example.contact;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import  android.content.Intent;
import android.net.Uri;
import android.provider.ContactsContract;
import android.widget.Button;
import android.widget.Toast;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        Button insertBtn=findViewById(R.id.insert_btn);
        insertBtn.setOnClickListener(view -> insertContact());

    }
    public void insertContact(){
        Intent intent= new Intent(
                ContactsContract.Intents.SHOW_OR_CREATE_CONTACT,
                ContactsContract.Contacts.CONTENT_URI
        );
        intent.setData(Uri.parse("tel:011-9999999"));
        intent.putExtra(ContactsContract.Intents.Insert.NAME,"John Doe");
        intent.putExtra(ContactsContract.Intents.Insert.PHONE,"011-9999999");
        intent.putExtra(ContactsContract.Intents.Insert.EMAIL,"johndoe@gmail.com");
        intent.putExtra(ContactsContract.Intents.Insert.COMPANY,"Google");
        intent.putExtra(ContactsContract.Intents.Insert.POSTAL,"House Address, stree number 1, pune");
        startActivity(intent);
        Toast.makeText(this,"Contact inserted",Toast.LENGTH_SHORT).show();
    }
}