<script>
    function search($cols) {
        // Declare variables
        var input, filter, table, tr, td, i, item, txtValue, itemValue;
        input = document.getElementById("mySearch");
        filter = input.value.toUpperCase();
        table = document.getElementById("tables");
        tr = table.getElementsByTagName("tr");
        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            for (j = 0; j < $cols; j++) {
                td = tr[i].getElementsByTagName("td")[0];
                item = tr[i].getElementsByTagName("td")[j];
                if (td || item) {
                    txtValue = td.textContent || td.innerText;
                    itemValue = item.textContent || item.innerText;
                    console.log("row: " + i + " column: " + j + " itemValue: " + itemValue + " txtValue: " + txtValue + " filter: " + filter);
                    if (itemValue.toUpperCase().includes(filter) || itemValue.includes(input.value) ||
                        itemValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "table-row";
                        j=$cols-1;
                        console.log("true");
                        console.log(tr[i].style.display)
                    } else if (!itemValue.toUpperCase().includes(filter) || !itemValue.includes(input.value) ||
                        !itemValue.toUpperCase().indexOf(filter) > -1){
                        tr[i].style.display = "none";
                        console.log("false");
                        console.log(tr[i].style.display)
                    }
                }

            }
        }

    }
</script>