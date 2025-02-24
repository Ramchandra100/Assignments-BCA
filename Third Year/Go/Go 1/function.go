package main
import "fmt"

func table(){
	var i,n int
        fmt.Print("Enter a number : ")
        fmt.Scan(&n)
        for i=1;i<11;i++{
                fmt.Println(n ,"X", i ,"=", n*i)
        }
}

func main(){
	table()
}
