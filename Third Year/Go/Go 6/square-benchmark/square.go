package main

import "fmt"

// Square function to calculate the square of a number
func Square(n int) int {
	return n * n
}

func main() {
	// Example usage of the Square function
	result := Square(5)
	fmt.Println("Square of 5:", result)
}
