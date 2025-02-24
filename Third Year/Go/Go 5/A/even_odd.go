package main

import (
	"fmt"
	"sync"
)

// Function to check if a number is even
func isEven(num int) bool {
	return num%2 == 0
}

// Function to handle even numbers
func handleEven(evenChan <-chan int, wg *sync.WaitGroup) {
	defer wg.Done()
	for num := range evenChan {
		fmt.Printf("Even: %d\n", num)
	}
}

// Function to handle odd numbers
func handleOdd(oddChan <-chan int, wg *sync.WaitGroup) {
	defer wg.Done()
	for num := range oddChan {
		fmt.Printf("Odd: %d\n", num)
	}
}

func main() {
	// Create a slice of integers
	numbers := []int{1, 2, 3, 4, 5, 6, 7, 8, 9, 10}

	// Create channels for even and odd numbers
	evenChan := make(chan int)
	oddChan := make(chan int)

	// Create a WaitGroup to wait for goroutines to finish
	var wg sync.WaitGroup

	// Launch goroutines to handle even and odd numbers
	wg.Add(2)
	go handleEven(evenChan, &wg)
	go handleOdd(oddChan, &wg)

	// Iterate over the slice and send numbers to respective channels
	for _, num := range numbers {
		if isEven(num) {
			evenChan <- num
		} else {
			oddChan <- num
		}
	}

	// Close the channels after sending all numbers
	close(evenChan)
	close(oddChan)

	// Wait for all goroutines to finish
	wg.Wait()

	fmt.Println("All numbers have been processed.")
}