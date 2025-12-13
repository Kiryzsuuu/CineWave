#!/bin/bash
# MongoDB Atlas IP Whitelist Script
# Azure CineWave App Outbound IPs

# List of all Azure outbound IPs for CineWave
IPS=(
  "70.153.131.52"
  "70.153.131.53"
  "70.153.129.93"
  "70.153.129.136"
  "70.153.129.145"
  "70.153.129.193"
  "70.153.112.175"
  "70.153.112.196"
  "70.153.112.237"
  "70.153.104.60"
  "70.153.104.66"
  "70.153.112.98"
  "70.153.129.43"
  "70.153.129.129"
  "70.153.130.169"
  "70.153.130.251"
  "70.153.129.141"
  "70.153.131.25"
  "70.153.161.0"
)

echo "=========================================="
echo "MongoDB Atlas IP Whitelist Configuration"
echo "=========================================="
echo ""
echo "Cluster: CNW"
echo "Database: cinewave"
echo ""
echo "OPTION 1 - Quick Setup (For Testing):"
echo "  Go to: https://cloud.mongodb.com"
echo "  1. Select cluster 'CNW'"
echo "  2. Network Access → Add IP Address"
echo "  3. Add: 0.0.0.0/0 (Allow from Anywhere)"
echo "  4. Click 'Confirm'"
echo ""
echo "OPTION 2 - Production Setup (Recommended):"
echo "  Add each IP address below individually:"
echo ""
for ip in "${IPS[@]}"; do
  echo "  - $ip"
done
echo ""
echo "=========================================="
echo "After whitelisting, run:"
echo "  az webapp restart --name CineWave --resource-group WebOpet"
echo "=========================================="
