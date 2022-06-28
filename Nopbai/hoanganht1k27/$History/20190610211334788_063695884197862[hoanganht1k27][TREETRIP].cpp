#include<bits/stdc++.h>
#define ii pair<long long,long long>
#define X first
#define Y second
using namespace std;
const long long N=200004;
long long n,A,B,vc=1000000000000000000,f[N][3];
vector<ii> a[N];
void dfs(long long x,long long p)
{
    f[x][0]=f[x][1]=vc;
    for(long long i=0;i<a[x].size();i++)
    {
        long long y=a[x][i].Y;
        if(y==p) continue;
        dfs(y,x);
    }
    long long keep=0,ch=0,sum=0;
    for(long long i=0;i<a[x].size();i++)
    {
        long long y=a[x][i].Y;
        if(y==p) continue;
        keep+=min(f[y][0],f[y][1])+B;
        sum+=min(f[y][0],f[y][1]);
        ch++;
    }
    if(ch==0){
        f[x][0]=f[x][1]=0;
        return;
    }
    f[x][1]=min(f[x][1],keep);
    keep=B*(ch-1);
    for(long long i=0;i<a[x].size();i++)
    {
        long long y=a[x][i].Y;
        if(y==p) continue;
        f[x][1]=min(f[x][1],sum-min(f[y][0],f[y][1])+keep+f[y][1]+A*a[x][i].X);
    }
    long long m1,m2;
    m1=m2=vc;
    for(long long i=0;i<a[x].size();i++)
    {
        long long y=a[x][i].Y;
        if(y==p) continue;
        long long k=-min(f[y][1],f[y][0])+f[y][1]+A*a[x][i].X;
        if(m1>k)
        {
            m2=m1;
            m1=k;
        }
        else if(m2>k) m2=k;
    }
    if(ch>=2)
    {
    f[x][0]=sum+m1+m2+keep-B;
    //cout<<m1<<" "<<m2<<" "<<sum<<" "<<x<<endl;
    }
}
int main()
{
    freopen("TREETRIP.INP","r",stdin);
    freopen("TREETRIP.OUT","w",stdout);
    scanf("%lld%lld%lld",&n,&A,&B);
    for(long long i=1;i<n;i++)
    {
        long long u,v,c;
        scanf("%lld%lld%lld",&u,&v,&c);
        a[u].push_back(ii(c,v));
        a[v].push_back(ii(c,u));
    }
    if(n==2)
    {
        cout<<min(2*B,2*A*a[1][0].X);
        return 0;
    }
    dfs(1,0);
    cout<<min(f[1][0],f[1][1])+B;
}
