<?php
include '../db.php';

$sql = "SELECT id, name, email, role FROM users ORDER BY name ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0): ?>
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-bold mb-4">All Users</h2>
        <table class="w-full text-left border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">Name</th>
                    <th class="p-2 border">Email</th>
                    <th class="p-2 border">Role</th>
                    <th class="p-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="p-2 border"><?= htmlspecialchars($row['id']) ?></td>
                        <td class="p-2 border"><?= htmlspecialchars($row['name']) ?></td>
                        <td class="p-2 border"><?= htmlspecialchars($row['email']) ?></td>
                        <td class="p-2 border"><?= htmlspecialchars($row['role']) ?></td>
                        <td class="p-2 border">
                            <!-- Edit Button -->
                            <a href="/myhotelbooking.com/Auth/edit_user.php?id=<?= $row['id'] ?>" class="bg-blue-500 text-white text-sm px-4 py-2 rounded hover:bg-blue-600 mr-2">Edit</a>

                            <!-- Delete Button -->
                            <form method="POST" action="/myhotelbooking.com/Auth/delete_user.php" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                                <button type="submit" class="bg-red-500 text-white text-sm px-4 py-2 rounded hover:bg-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p>No users found.</p>
<?php endif; ?>
