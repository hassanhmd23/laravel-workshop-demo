import './bootstrap';

document.addEventListener("DOMContentLoaded", function () {
    const notificationBtn = document.getElementById("notification-btn");
    const notificationDropdown = document.getElementById("notification-dropdown");
    const notificationBadge = document.getElementById("notification-badge");
    const notificationList = document.getElementById("notification-list");

    notificationBtn.addEventListener("click", () => {
        notificationDropdown.classList.toggle("hidden");
    });

    notificationList.addEventListener("click", async (event) => {
        const notificationItem = event.target.closest("[data-notification-id]");
        if (!notificationItem) return;

        const notificationId = notificationItem.getAttribute("data-notification-id");
        const taskId = notificationItem.getAttribute("data-task-id");

        await markNotificationAsRead(notificationId);

        window.location.href = `/tasks/${taskId}`;
    });

    const userId = window.Laravel.user;

    if (window.Echo && userId) {
        window.Echo.private(`App.Models.User.${userId}`)
            .notification((notification) => {
                handleNewNotification(notification);
            });
    }

    function handleNewNotification(notification) {
        const {message, taskId, unreadCount, id} = notification;

        console.log("New notification", message, taskId, unreadCount, id);

        const item = document.createElement("div");
        item.classList.add("p-2", "border-b", "hover:bg-gray-100", "cursor-pointer");
        item.setAttribute("data-notification-id", id);
        item.setAttribute("data-task-id", taskId);
        item.innerHTML = `<p class="text-sm">${message}</p>`;

        notificationList.prepend(item);

        updateUnreadCount(unreadCount);
    }

    async function markNotificationAsRead(notificationId) {
        try {
            const response = await fetch(`/notifications/${notificationId}/mark-as-read`, {
                method: "POST", headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Content-Type": "application/json",
                },
            });

            if (!response.ok) {
                console.error("Failed to mark notification as read");
            }
        } catch (error) {
            console.error("Error marking notification as read", error);
        }
    }

    function updateUnreadCount(count) {
        notificationBadge.textContent = count;
        notificationBadge.classList.toggle("hidden", count === 0);
    }
});
