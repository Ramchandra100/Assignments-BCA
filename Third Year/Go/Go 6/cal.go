package main
import (
	"fmt"
	"MyPackage/calculator"	
	"os"
)
func main(){
	ch,a,b:=0,0,0
	fmt.Print("Enter number A : ")
	fmt.Scan(&a)
	fmt.Print("Enter number B : ")
	fmt.Scan(&b)
	for{
	fmt.Printf("1. ADD\t2. Substract\t3. Multiplication\t4. Division\t5. Exit\nOPTION : ")
	fmt.Scan(&ch)
	switch ch{
	case 1:
		fmt.Println("Addition : ",calculator.Add(a,b))
	case 2:
		fmt.Println("Substraction : ",calculator.Sub(a,b))
	case 3: 
                fmt.Println("Multiplication : ",calculator.Mul(a,b))
        case 4: 
                fmt.Println("Division : ",calculator.Div(a,b))
	case 5:
		os.Exit(0) 
	}
}
	fmt.Println("Thanks ")
}
