package main

import "fmt"

// Subtract function to subtract two integers
func Subtract(a, b int) int {
	return a - b
}

func main() {
	// Example usage of Subtract function
	result := Subtract(10, 5)
	fmt.Println("Result of subtraction:", result)
}
