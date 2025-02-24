package main 
import "fmt"
import "strings"
func main () {
	str1 := "One"
	str2 := "n"
	if strings.Contains(str1,str2) {
		fmt.Println("String is subtring of another string")
	} else {
		fmt.Println("String is not subset of another string")
	}
}
