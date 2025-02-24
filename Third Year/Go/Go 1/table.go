package main
import "fmt"
func main(){
	var r int
	fmt.Print("Enter Number of rows : ")
	fmt.Scanln(&r)
	fmt.Println("***********PASCAL Triangle Pattern**********")
	for i:=0; i<r;i++{
		n:=1
		for j:=0;j<r-i-1;j++{
			fmt.Print(" ")
		}
		for j:=0;j<=i;j++{
			fmt.Print(n," ")
			n=n*(i-j)/(j+1)
		}
		fmt.Println()
	}
}
