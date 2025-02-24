package main

import (
	"fmt"
	"strconv"
)

// Function to calculate the sum of squares of the digits
func sumOfSquares(number int, result chan int) {
	sum := 0
	for _, digit := range strconv.Itoa(number) {
		d, _ := strconv.Atoi(string(digit))
		sum += d * d
	}
	result <- sum
}

// Function to calculate the sum of cubes of the digits
func sumOfCubes(number int, result chan int) {
	sum := 0
	for _, digit := range strconv.Itoa(number) {
		d, _ := strconv.Atoi(string(digit))
		sum += d * d * d
	}
	result <- sum
}

func main() {
	number := 123

	// Create channels to receive results
	squaresChan := make(chan int)
	cubesChan := make(chan int)

	// Launch goroutines to calculate squares and cubes
	go sumOfSquares(number, squaresChan)
	go sumOfCubes(number, cubesChan)

	// Receive results from channels
	sumSquares := <-squaresChan
	sumCubes := <-cubesChan

	// Calculate the final sum
	finalSum := sumSquares + sumCubes

	// Print the results
	fmt.Printf("Sum of squares = %d\n", sumSquares)
	fmt.Printf("Sum of cubes = %d\n", sumCubes)
	fmt.Printf("Final sum of squares and cubes = %d\n", finalSum)
}