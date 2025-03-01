package main

import (
	"fmt"
	"sort"
)

type Student struct {
	Name  string
	Marks int
}


type ByMarks []Student


func (a ByMarks) Len() int {
	return len(a)
}


func (a ByMarks) Swap(i, j int) {
	a[i], a[j] = a[j], a[i]
}


func (a ByMarks) Less(i, j int) bool {
	return a[i].Marks < a[j].Marks
}

func main() {
	students := []Student{
		{"Alice", 85},
		{"Bob", 90},
		{"Charlie", 78},
		{"David", 88},
	}

	sort.Sort(ByMarks(students))

	fmt.Println("Sorted Students:")
	for _, student := range students {
		fmt.Printf("Name: %s, Marks: %d\n", student.Name, student.Marks)
	}
}

