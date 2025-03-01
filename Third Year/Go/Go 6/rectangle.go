package rectangle
import "fmt"
func Rec(){
	l,b:=0,0
	fmt.Print("Enter Length : ")
	fmt.Scan(&l)
	fmt.Print("Enter Breadth : ")
	fmt.Scan(&b)
	fmt.Println("Area of Rectangle is : ",l*b)
}
//	(base) [root@localhost rectangle]# pwd
//	/usr/lib/golang/src/MyPackage/rectangle

//	(base) [root@localhost calculator]# go build
//	(base) [root@localhost calculator]# go install


