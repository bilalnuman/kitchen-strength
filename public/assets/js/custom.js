"use strict";

async function handleDelete(data, endpoint, event) {

    const id = data?.[0] ?? null

    const button = event.target;
    const type = button.getAttribute('data-type');
    const container = document.getElementById(endpoint)

    const ul = document.querySelector(`#${type}`);

    try {
        const response = await fetch(`/${endpoint}/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });

        const res = await response.json();

        if (res.success) {
            if (id) {
                const item = document.getElementById(`${type}-${id}`)
                item.remove();
                if (ul?.children?.length == 1) {
                    ul.remove();
                }

                if (endpoint !== 'plan-days/recipe' && container?.children?.length == 1) {
                    document.getElementById('notfound')?.classList.remove('d-none')
                    document.querySelector(`.${endpoint}`)?.remove()
                }
                if (endpoint === 'plan-days/recipe') {
                    const el = document.getElementById(`day-container-${data[1]}`)
                    if (el.children.length === 2) {
                        console.log(el.children[1].classList.remove('d-none'))
                    }
                }
            }
            else {
                const ingradients = document.querySelectorAll(`#${endpoint} ul`)
                Array.from(ingradients).forEach(el => {
                    el.remove()
                })
                document.querySelector(`.${endpoint}`)?.remove()
                document.getElementById('notfound')?.classList.remove('d-none')
            }
        } else {
            alert('Failed to delete item.');
        }
    } catch (error) {
        console.log(error)
    }
}

async function addToFavorite(recipe_id) {
    let res = await fetch(`http://127.0.0.1:8000/favourite/${recipe_id}`)
    res = await res.json()
    alert(res.message)
}


