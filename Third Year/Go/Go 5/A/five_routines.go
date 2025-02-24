package main

import (
	"fmt"
	"math/rand"
	"sync"
	"time"
)

func generateNumbers(id int, wg *sync.WaitGroup) {
	defer wg.Done() // Notify the WaitGroup that this goroutine is done

	for i := 0; i <= 10; i++ {
		fmt.Printf("Goroutine %d: %d\n", id, i)
		// Generate a random delay between 0 and 250 milliseconds
		delay := time.Duration(rand.Intn(251)) * time.Millisecond
		time.Sleep(delay)
	}
}

func main() {
	rand.Seed(time.Now().UnixNano()) // Seed the random number generator

	var wg sync.WaitGroup // Create a WaitGroup to wait for all goroutines to finish

	// Launch 5 goroutines
	for i := 1; i <= 5; i++ {
		wg.Add(1) // Increment the WaitGroup counter
		go generateNumbers(i, &wg)
	}

	wg.Wait() // Wait for all goroutines to finish
	fmt.Println("All goroutines have completed.")
}