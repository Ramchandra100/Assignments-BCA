package com.tc.calculator;

import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

public class MainActivity extends AppCompatActivity {
    //here start
    double part1=0.00,part2=0.00;
    int ch=-1;
    TextView textView;
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
        Button b1,b2,b3,b4,b5,b6,b7,b8,b9,bdot,b0,bBack,bMultipication,bSubstraction,bAddition,bDivision,bSubmit;
        EditText editText;




        textView=findViewById(R.id.resultw);
        b1=findViewById(R.id.onew);
        b2=findViewById(R.id.twow);
        b3=findViewById(R.id.threew);
        b4=findViewById(R.id.fourw);
        b5=findViewById(R.id.fivew);
        b6=findViewById(R.id.sixw);
        b7=findViewById(R.id.sevenw);
        b8=findViewById(R.id.eightw);
        b9=findViewById(R.id.ninew);
        bdot=findViewById(R.id.dotw);
        b0=findViewById(R.id.zerow);
        bBack=findViewById(R.id.backw);
        bMultipication=findViewById(R.id.multiplyw);
        bDivision=findViewById(R.id.divisionw);
        bSubstraction=findViewById(R.id.substractionw);
        bAddition=findViewById(R.id.additionw);
        bSubmit=findViewById(R.id.submitw);
        editText=findViewById(R.id.inputw);

        b1.setOnClickListener(v->{
            String val=editText.getText().toString()+"1";
            editText.setText(val);
        });
        b2.setOnClickListener(v->{
            String val=editText.getText().toString()+"2";
            editText.setText(val);
        });
        b3.setOnClickListener(v->{
            String val=editText.getText().toString()+"3";
            editText.setText(val);
        });
        b4.setOnClickListener(v->{
            String val=editText.getText().toString()+"4";
            editText.setText(val);
        });
        b5.setOnClickListener(v->{
            String val=editText.getText().toString()+"5";
            editText.setText(val);
        });
        b6.setOnClickListener(v->{
            String val=editText.getText().toString()+"6";
            editText.setText(val);
        });
        b7.setOnClickListener(v->{
            String val=editText.getText().toString()+"7";
            editText.setText(val);
        });
        b8.setOnClickListener(v->{
            String val=editText.getText().toString()+"8";
            editText.setText(val);
        });
        b9.setOnClickListener(v->{
            String val=editText.getText().toString()+"9";
            editText.setText(val);
        });
        b0.setOnClickListener(v->{
            String val=editText.getText().toString()+"0";
            editText.setText(val);
        });
        bdot.setOnClickListener(v->{
            String val=editText.getText().toString()+".";
            editText.setText(val);
        });
        bBack.setOnClickListener(v->{
            String val=editText.getText().toString();
            if(val.length()>0) {
                val = val.substring(0, val.length() - 1);
                editText.setText(val);
            }
        });
        bSubstraction.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String val=editText.getText().toString();
                textView.setText(textView.getText().toString()+val+"-");
                if(val.length()>0 && part1==0.00){
                    part1 =Double.parseDouble(val);
                    editText.setText("");
                    ch=0;
                }
                else{
                    part2 =Double.parseDouble(val);
                    editText.setText("Result : "+opration(part1,part2,ch)+"");
                    textView.setText("");
                }
            }
        });

        bMultipication.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String val=editText.getText().toString();
                textView.setText(textView.getText().toString()+val+"X");
                if(val.length()>0 && part1==0.00){
                    part1 =Double.parseDouble(val);
                    editText.setText("");
                    ch=2;
                }
                else{
                    part2 =Double.parseDouble(val);
                    editText.setText("Result : "+opration(part1,part2,ch)+"");
                    textView.setText("");
                }
            }
        });
        bAddition.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String val=editText.getText().toString();
                textView.setText(textView.getText().toString()+val+"+");
                if(val.length()>0 && part1==0.00){
                    part1 =Double.parseDouble(val);
                    editText.setText("");
                    ch=1;
                }
                else{
                    part2 =Double.parseDouble(val);
                    editText.setText("Result : "+opration(part1,part2,ch)+"");
                    textView.setText("");
                }
            }
        });
        bDivision.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String val=editText.getText().toString();
                textView.setText(textView.getText().toString()+val+"/");
                if(val.length()>0 && part1==0.00){
                    part1 =Double.parseDouble(val);
                    editText.setText("");
                    ch=3;
                }
                else{
                    part2 =Double.parseDouble(val);
                    editText.setText("Result : "+opration(part1,part2,ch)+"");
                    textView.setText("");
                }
            }
        });
        bSubmit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String val=editText.getText().toString();
                if( part1!=0.00 && ch!=-1){
                    part2 =Double.parseDouble(val);
                    editText.setText("Result : "+opration(part1,part2,ch)+"");
                    textView.setText("");
                }
            }
        });

    }


    public double opration(double x,double y, int ch){
        switch (ch){
            case 0:
                return x-y;
            case 1:
                return x+2;
            case 2:
                return x*y;
            case 3:
                return x/y;
        }
        return x;
    }
}