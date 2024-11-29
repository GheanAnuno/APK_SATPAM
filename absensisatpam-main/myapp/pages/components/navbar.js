import Link from "next/link";
import { useState } from "react";

function Navbar() {
  const [activeLink, setActiveLink] = useState("profile");

  const handleLinkClick = (link) => {
    setActiveLink(link);
  };

  return (
    <nav className="bg-gray-800">
      <div className="container mx-auto px-4 py-2 flex justify-between">
        <div className="text-white font-bold">Sistem Manajemen Satpam</div>
        <div className="flex space-x-4">
          <Link
            href="/profile"
            className={`text-white hover:text-blue-500 ${
              activeLink === "profile" ? "underline" : ""
            }`}
            onClick={() => handleLinkClick("profile")}
          >
            Profile
          </Link>
          <Link
            href="/jadwal"
            className={`text-white hover:text-blue-500 ${
              activeLink === "jadwal" ? "underline" : ""
            }`}
            onClick={() => handleLinkClick("jadwal")}
          >
            Jadwal
          </Link>
          <Link
            href="/shift"
            className={`text-white hover:text-blue-500 ${
              activeLink === "shift" ? "underline" : ""
            }`}
            onClick={() => handleLinkClick("shift")}
          >
            Shift
          </Link>
          <Link
            href="/laporan-bulanan"
            className={`text-white hover:text-blue-500 ${
              activeLink === "laporan-bulanan" ? "underline" : ""
            }`}
            onClick={() => handleLinkClick("laporan-bulanan")}
          >
            Laporan Bulanan
          </Link>
          <Link
            href="/gaji"
            className={`text-white hover:text-blue-500 ${
              activeLink === "gaji" ? "underline" : ""
            }`}
            onClick={() => handleLinkClick("gaji")}
          >
            Gaji
          </Link>
        </div>
      </div>
    </nav>
  );
}

export default  Navbar;
