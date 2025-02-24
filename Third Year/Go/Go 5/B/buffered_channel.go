package main

import (
	"fmt"
)

func main() {
	// Create a buffered channel with a capacity of 5
	bufferedChan := make(chan int, 5)

	// Store values in the channel
	values := []int{10, 20, 30, 40, 50}
	for _, val := range values {
		bufferedChan <- val
	}

	// Find the capacity and length of the channel
	capacity := cap(bufferedChan)
	length := len(bufferedChan)

	fmt.Printf("Initial capacity of the channel: %d\n", capacity)
	fmt.Printf("Initial length of the channel: %d\n", length)

	// Read values from the channel
	for i := 0; i < length; i++ {
		value := <-bufferedChan
		fmt.Printf("Read value from channel: %d\n", value)
	}

	// Find the modified length of the channel
	modifiedLength := len(bufferedChan)
	fmt.Printf("Modified length of the channel: %d\n", modifiedLength)
}