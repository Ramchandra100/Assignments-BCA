package main

import (
	"fmt"
)

func main() {
	// Create a channel to hold integers
	ch := make(chan int)

	// Launch a goroutine to send values to the channel
	go func() {
		// Send values to the channel
		for i := 1; i <= 5; i++ {
			ch <- i
		}
		// Close the channel after sending all values
		close(ch)
	}()

	// Read values from the channel using a for-range loop
	for num := range ch {
		fmt.Println("Received:", num)
	}

	fmt.Println("Channel is closed and all values have been received.")
}