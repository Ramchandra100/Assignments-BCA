package main

import (
	"fmt"
	"sync"
)

// Function to generate Fibonacci series and write to the channel
func generateFibonacci(ch chan<- int, n int, wg *sync.WaitGroup) {
	defer wg.Done()
	a, b := 0, 1
	for i := 0; i < n; i++ {
		ch <- a
		a, b = b, a+b
	}
	close(ch) // Close the channel after sending all Fibonacci numbers
}

// Function to read from the channel and print the values
func readFibonacci(ch <-chan int, wg *sync.WaitGroup) {
	defer wg.Done()
	for num := range ch {
		fmt.Println(num)
	}
}

func main() {
	// Define the number of Fibonacci numbers to generate
	n := 10

	// Create a channel to hold Fibonacci numbers
	fibChan := make(chan int)

	// Create a WaitGroup to wait for goroutines to finish
	var wg sync.WaitGroup

	// Start the goroutine to generate Fibonacci series
	wg.Add(1)
	go generateFibonacci(fibChan, n, &wg)

	// Start the goroutine to read and print Fibonacci series
	wg.Add(1)
	go readFibonacci(fibChan, &wg)

	// Wait for all goroutines to finish
	wg.Wait()

	fmt.Println("Fibonacci series generation and reading completed.")
}