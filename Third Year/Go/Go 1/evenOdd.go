package main
import "fmt"
func main(){
	var n int
	fmt.Print("Enter a number to check : ")
	fmt.Scanf("%d",&n)
	if(n%2==0){
	fmt.Println("Even")
	}else{
	fmt.Println("Odd")
	}
}
