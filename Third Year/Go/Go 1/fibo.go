package main
import "fmt"
func main(){
	var nn,n int
	t1,t2:=1,1
	fmt.Print("Enter number of terms : ")
	fmt.Scan(&n)
	fmt.Print("Fibonacci Series : 0 1 1" )
	for i:=3;i<n;i++{
		nn=t1+t2
		t1=t2
		t2=nn
		fmt.Print(" ",nn)
	}
	fmt.Println()
}
