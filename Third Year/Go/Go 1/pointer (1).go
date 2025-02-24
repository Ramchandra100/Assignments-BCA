package main
import "fmt"
func main(){
	a:=300
	var ptr *int
	var pptr **int
	ptr=&a
	pptr=&ptr
	fmt.Println("value of a : ",a)
	fmt.Println("Addres of a : ",&a)
	fmt.Println("value in pptr : ",*pptr)
	fmt.Println("value ** : ",**pptr)
	fmt.Println("value of ptr : ",*ptr)
}
