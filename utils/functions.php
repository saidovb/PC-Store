<?php

function user() {
	return $_SESSION["user"] ?? null;
}

function isAdmin() {
	return user() && user()["is_admin"] == 1;
}