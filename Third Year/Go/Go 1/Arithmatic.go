package main
import "fmt"
func main(){
	var a,b,c int
	fmt.Print("Enter value of a : ")
	fmt.Scan(&a)
	fmt.Print("Enter value of b : ")
	fmt.Scan(&b)
	for{
		fmt.Printf("1.Addition\n2.Substration\n3.Division\n4.Multiplication\nEnter your choice : ")
		fmt.Scan(&c)
		switch c{
		case 1:
			fmt.Println("Addition : ",a+b)
		case 2:
			fmt.Println("Substraction : ",a-b)
		case 3:
			fmt.Println("Division : ",a/b)
		case 4:
			fmt.Println("Multiplication : ",a*b)
		default:
			fmt.Println("Please enter a valid choice ")
	}
}
}
