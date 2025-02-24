package main
import "fmt"
func main(){
	var n,cn,div string
//	var cn string
//	var div string
	var rn int
	fmt.Print("Enter name : ")
	fmt.Scanf("%s",&n)
	fmt.Print("Enter Roll Number : ")
        fmt.Scanf("%d",&rn)
	fmt.Print("Enter division : ")
        fmt.Scanf("%s",&div)
	fmt.Print("Enter College name : ")
        fmt.Scanf("%s",&cn)
	fmt.Printf("Name : %s",n)
	fmt.Printf("Roll number : %d",rn)
	fmt.Printf("Division : %s",div)
	fmt.Printf("College Name : %s",cn)
}
